<?php

declare(strict_types=1);

namespace Src\UseCases\Client;


use Src\Entities\Client\ValueObjects\ClientId;
use Src\Interfaces\Client\ClientGatewayInterface;

final class DeleteClientUseCase
{
    public function __construct(
        private ClientGatewayInterface $gateway
    ){
    }

    public function __invoke(int $clientId): void
    {
        $id = new ClientId($clientId);

        $this->gateway->delete($id);
    }
}
