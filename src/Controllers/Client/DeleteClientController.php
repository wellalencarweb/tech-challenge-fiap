<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ClientAdapter;
use Src\Gateways\Client\ClientGateway;
use Src\UseCases\Client\DeleteClientUseCase;
use Src\UseCases\Client\GetClientUseCase;

final class DeleteClientController
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
        $client           = $getClientUseCase->__invoke($clientId);

        if (!$client) {
            return $this->clientAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => 'client not found'],
                    Response::HTTP_NOT_FOUND
                );
        }

        $deleteClientUseCase = new DeleteClientUseCase($this->gateway);
        $deleteClientUseCase->__invoke($clientId);

        return $this->clientAdapter->adaptJsonClients([], Response::HTTP_NO_CONTENT);
    }
}
