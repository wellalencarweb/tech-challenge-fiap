<?php

declare(strict_types=1);

namespace Src\Interfaces\Client;

use Src\Entities\Client\Client;
use Src\Entities\Client\ValueObjects\ClientCpf;
use Src\Entities\Client\ValueObjects\ClientEmail;
use Src\Entities\Client\ValueObjects\ClientId;
use Src\Entities\Client\ValueObjects\ClientName;

interface ClientGatewayInterface
{
    public function find(ClientId $id): ?Client;

    public function findByCriteria(ClientName $clientName, ClientEmail $clientEmail, ClientCpf $clientCpf): array;

    public function save(Client $client): Client;

    public function update(Client $client): void;

    public function delete(ClientId $id): void;
}
