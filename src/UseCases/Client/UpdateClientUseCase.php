<?php

declare(strict_types=1);

namespace Src\UseCases\Client;

use Src\Entities\Client\Client;
use Src\Interfaces\Client\ClientGatewayInterface;
use Src\Entities\Client\ValueObjects\ClientCpf;
use Src\Entities\Client\ValueObjects\ClientEmail;
use Src\Entities\Client\ValueObjects\ClientId;
use Src\Entities\Client\ValueObjects\ClientName;

final class UpdateClientUseCase
{
    public function __construct(
        private ClientGatewayInterface $gateway
    ){
    }

    public function __invoke(
        int $clientId,
        ?string $clientName,
        ?string $clientEmail,
        ?string $clientCpf,
    ): void
    {
        $id                = new ClientId($clientId);
        $name              = new ClientName($clientName);
        $email             = new ClientEmail($clientEmail);
        $cpf               = new ClientCpf($clientCpf);

        $client = Client::create($id,$name, $email, $cpf);

        $this->gateway->update($client);
    }
}
