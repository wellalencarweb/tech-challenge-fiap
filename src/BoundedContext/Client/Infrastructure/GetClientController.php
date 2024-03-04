<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Client\Application\GetClientUseCase;
use Src\BoundedContext\Client\Infrastructure\Eloquent\EloquentClientRepository;

final class GetClientController
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
        return $getClientUseCase->__invoke($clientId);
    }
}
