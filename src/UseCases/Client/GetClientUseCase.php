<?php

declare(strict_types=1);

namespace Src\UseCases\Client;


use Src\Entities\Client\Client;
use Src\Entities\Client\ValueObjects\ClientId;
use Src\Interfaces\Client\ClientGatewayInterface;

final class GetClientUseCase
{
    private ClientGatewayInterface $gateway;

    public function __construct(ClientGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function __invoke(int $clientId): ?Client
    {
        $id = new ClientId($clientId);

        return $this->gateway->find($id);
    }
}
