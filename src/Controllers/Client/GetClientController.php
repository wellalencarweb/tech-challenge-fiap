<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\UseCases\Client\GetClientUseCase;
use Src\Gateways\Client\ClientGateway;

final class GetClientController
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
        $clientId = (int)$request->id;

        $getClientUseCase = new GetClientUseCase($this->gateway);
        $clientData = $getClientUseCase->__invoke($clientId);

        if (!$clientData) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => 'client not found'],
                    Response::HTTP_NOT_FOUND
                );
        }

        return $this->clientAdapter->adaptJsonClients($clientData, Response::HTTP_OK);
    }
}
