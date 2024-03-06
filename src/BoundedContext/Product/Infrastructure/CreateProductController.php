<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\CreateProductUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductGateway;

final class CreateProductController
{
    private ProductGateway $repository;

    public function __construct(ProductGateway $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $productName            = $request->input('name');
        $productDescription     = $request->input('description');
        $productPrice           = (float) $request->input('price');
        $productCategoryId      = (int) $request->input('category_id');

        $createProductUseCase = new CreateProductUseCase($this->repository);

        return $createProductUseCase->__invoke(
            $productName,
            $productDescription,
            $productPrice,
            $productCategoryId
        );
    }
}
