<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain\Contracts;

use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientCpf;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;

interface ClientRepositoryContract
{
    public function find(ClientId $id): ?Client;

    public function findByCriteria(ClientName $clientName, ClientEmail $clientEmail, ClientCpf $clientCpf): array;

    public function save(Client $client): Client;

    public function update(Client $client): void;

    public function delete(ClientId $id): void;
}
