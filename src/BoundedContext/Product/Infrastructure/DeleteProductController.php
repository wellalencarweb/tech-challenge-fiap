<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\DeleteProductUseCase;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\EloquentProductRepository;

final class DeleteProductController
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
        $product           = $getProductUseCase->__invoke($productId);

        if (!$product) {
            return null;
        }

        $deleteProductUseCase = new DeleteProductUseCase($this->repository);
        $deleteProductUseCase->__invoke($productId);

        return true;
    }
}
