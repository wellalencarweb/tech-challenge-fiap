<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Product\Application\GetProductByCriteriaUseCase;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductGateway;

final class GetProductByCriteriaController
{
    private ProductGateway $repository;

    public function __construct(ProductGateway $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $productCategory = $request->input('category') ?? null;

        $getProductByCriteriaUseCase = new GetProductByCriteriaUseCase($this->repository);
        return $getProductByCriteriaUseCase->__invoke($productCategory);
    }
}
