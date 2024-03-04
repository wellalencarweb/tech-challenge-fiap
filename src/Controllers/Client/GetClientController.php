<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Http\Request;
use Src\UseCases\Client\GetClientUseCase;
use Src\Gateways\Client\ClientGateway;

final class GetClientController
{
    private ClientGateway $gateway;

    public function __construct(ClientGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function __invoke(Request $request)
    {
        $clientId = (int)$request->id;

        $getClientUseCase = new GetClientUseCase($this->gateway);
        return $getClientUseCase->__invoke($clientId);
    }
}
