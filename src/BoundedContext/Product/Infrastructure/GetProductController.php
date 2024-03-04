<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\EloquentProductRepository;

final class GetProductController
{
    private EloquentProductRepository $repository;

    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $productId = (int)$request->id;

        $getProductUseCase = new GetProductUseCase($this->repository);
        return $getProductUseCase->__invoke($productId);
    }
}
