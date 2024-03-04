<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductUseCase;
use Src\BoundedContext\Product\Application\UpdateProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\EloquentProductRepository;

final class UpdateProductController
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


        $productName            = $request->input('name') ?? $product->name()->value();
        $productDescription     = $request->input('description') ?? $product->description()->value();
        $productPrice           = (float) $request->input('price') ?? $product->price()->value();
        $productCategoryId      = (int) $request->input('category_id') ?? $product->categoryId()->value();
        $productActive          = (bool) $request->input('active') ?? $product->active()->value();


        $updateProductUseCase = new UpdateProductUseCase($this->repository);
        $updateProductUseCase->__invoke(
            $productId,
            $productName,
            $productDescription,
            $productPrice,
            $productCategoryId,
            $productActive
        );

        return $getProductUseCase->__invoke($productId);
    }
}
