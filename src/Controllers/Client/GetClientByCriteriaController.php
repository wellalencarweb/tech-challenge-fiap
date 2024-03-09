<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\Gateways\Client\ClientGateway;
use Src\UseCases\Client\GetClientByCriteriaUseCase;

final class GetClientByCriteriaController
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
            $clientName  = $request->input('name') ?? null;
            $clientEmail = $request->input('email') ?? null;
            $clientCpf   = $request->input('cpf') ?? null;

            $getClientByCriteriaUseCase = new GetClientByCriteriaUseCase($this->gateway);
            $clientsData = $getClientByCriteriaUseCase->__invoke($clientName, $clientEmail, $clientCpf);

            if (!$clientsData) {
                return $this->clientAdapter
                    ->adaptJsonMessageError(
                        ['status' => 'error', 'message' => 'client not found'],
                        Response::HTTP_NOT_FOUND
                    );
            }

            return $this->clientAdapter->adaptJsonClients($clientsData, Response::HTTP_OK);
        } catch (\InvalidArgumentException $e) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
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
