<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientCpf;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;

final class GetClientByCriteriaUseCase
{
    private ClientRepositoryContract $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $clientName,
        ?string $clientEmail,
        ?string $clientCpf
    ): array
    {
        $name   = new ClientName($clientName);
        $email  = new ClientEmail($clientEmail);
        $cpf    = new ClientCpf($clientCpf);

        return $this->repository->findByCriteria($name, $email, $cpf);
    }
}
