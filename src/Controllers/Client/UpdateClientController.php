<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;
use Src\Adapters\ClientAdapter;
use Src\Gateways\Client\ClientGateway;
use Src\UseCases\Client\GetClientUseCase;
use Src\UseCases\Client\UpdateClientUseCase;

final class UpdateClientController
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
            $clientId = (int)$request->id;

            $getClientUseCase = new GetClientUseCase($this->gateway);
            $client           = $getClientUseCase->__invoke($clientId);

            if (!$client) {
                return $this->clientAdapter
                    ->adaptJsonMessageError(
                        ['status' => 'error', 'message' => 'client not found'],
                        Response::HTTP_NOT_FOUND
                    );
            }

            $clientName     = $request->input('name') ?? $client->name()->value();
            $clientEmail    = $request->input('email') ?? $client->email()->value();
            $clientCpf      = $request->input('cpf') ?? $client->cpf()->value();

            $updateClientUseCase = new UpdateClientUseCase($this->gateway);
            $updateClientUseCase->__invoke(
                $clientId,
                $clientName,
                $clientEmail,
                $clientCpf
            );

            $clientData = $getClientUseCase->__invoke($clientId);
            return $this->clientAdapter->adaptJsonClients($clientData, Response::HTTP_OK);
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
