<?php

declare(strict_types=1);

namespace Src\UseCases\Client;

use Src\Entities\Client\Client;
use Src\Entities\Client\ValueObjects\ClientCpf;
use Src\Entities\Client\ValueObjects\ClientEmail;
use Src\Entities\Client\ValueObjects\ClientId;
use Src\Entities\Client\ValueObjects\ClientName;
use Src\Interfaces\Client\ClientGatewayInterface;

final class CreateClientUseCase
{
    public function __construct(
        private ClientGatewayInterface $gateway
    ){
    }

    public function __invoke(
        ?string $clientName,
        ?string $clientEmail,
        ?string $clientCpf,
    ): Client
    {
        $id     = new ClientId(null);
        $name   = new ClientName($clientName);
        $email  = new ClientEmail($clientEmail);
        $cpf    = new ClientCpf($clientCpf);

        $client = Client::create($id, $name, $email, $cpf);

        return $this->gateway->save($client);
    }
}
