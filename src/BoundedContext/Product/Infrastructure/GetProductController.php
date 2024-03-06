<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductGateway;

final class GetProductController
{
    private ProductGateway $repository;

    public function __construct(ProductGateway $repository)
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
