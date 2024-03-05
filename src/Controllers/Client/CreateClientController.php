<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\Controllers\Client\Validations\CreateClientValidation;
use Src\Controllers\Exceptions\ValidationException;
use Src\Gateways\Client\ClientGateway;
use Src\UseCases\Client\CreateClientUseCase;

final class CreateClientController
{
    public function __construct(
        private ClientGateway $gateway,
        private ClientAdapter $clientAdapter
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): Response
    {

        try {
            CreateClientValidation::validate($request->all());

            $clientName   = $request->input('name') ?? null;
            $clientEmail  = $request->input('email') ?? null;
            $clientCpf    = $request->input('cpf') ?? null;

            $createClientUseCase = new CreateClientUseCase($this->gateway);

            $clientData = $createClientUseCase->__invoke(
                $clientName,
                $clientEmail,
                $clientCpf
            );

            return $this->clientAdapter->adaptJsonClients($clientData, Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
                );
        } catch (QueryException $e) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    [
                        'status' => 'error',
                        'message' => 'Error processing the request. Please try again.'
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        } catch (\Exception $e) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    ['error' => $e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
