<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\GetClientByCriteriaUseCase;
use Src\BoundedContext\Client\Infrastructure\Eloquent\EloquentClientRepository;

final class GetClientByCriteriaController
{
    private EloquentClientRepository $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $clientName  = $request->input('name') ?? null;
        $clientEmail = $request->input('email') ?? null;
        $clientCpf   = $request->input('cpf') ?? null;

        $getClientByCriteriaUseCase = new GetClientByCriteriaUseCase($this->repository);
        return $getClientByCriteriaUseCase->__invoke($clientName, $clientEmail, $clientCpf);
    }
}
