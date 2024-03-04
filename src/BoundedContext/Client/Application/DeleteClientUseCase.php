<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Application;

use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;

final class DeleteClientUseCase
{
    private ClientRepositoryContract $repository;

    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $clientId): void
    {
        $id = new ClientId($clientId);

        $this->repository->delete($id);
    }
}
