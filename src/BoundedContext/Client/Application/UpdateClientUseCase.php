<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientCpf;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;

final class UpdateClientUseCase
{
    private ClientRepositoryContract $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
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

        $this->repository->update($client);
    }
}
