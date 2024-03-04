<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\GetClientUseCase;
use Src\BoundedContext\Client\Application\UpdateClientUseCase;
use Src\BoundedContext\Client\Infrastructure\Eloquent\EloquentClientRepository;

final class UpdateClientController
{
    private EloquentClientRepository $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $clientId = (int)$request->id;

        $getClientUseCase = new GetClientUseCase($this->repository);
        $client           = $getClientUseCase->__invoke($clientId);

        if (!$client) {
            return null;
        }

        $clientName              = $request->input('name') ?? $client->name()->value();
        $clientEmail             = $request->input('email') ?? $client->email()->value();
        $clientCpf               = $request->input('cpf') ?? $client->cpf()->value();


        $updateClientUseCase = new UpdateClientUseCase($this->repository);
        $updateClientUseCase->__invoke(
            $clientId,
            $clientName,
            $clientEmail,
            $clientCpf
        );

        return $getClientUseCase->__invoke($clientId);
    }
}
