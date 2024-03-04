<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Application;

use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductActive;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCategoryId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductPrice;

final class CreateProductUseCase
{
    private ProductRepositoryContract $repository;

    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string  $productName,
        string  $productDescription,
        float   $productPrice,
        int     $productCategoryId
    ): Product
    {
        $id             = new ProductId(null);
        $name           = new ProductName($productName);
        $description    = new ProductDescription($productDescription);
        $price          = new ProductPrice($productPrice);
        $categoryId     = new ProductCategoryId($productCategoryId);
        $active         = new ProductActive(true);


        $product = Product::create($id,
            $name,
            $description,
            $price,
            $categoryId,
            $active
        );

        return $this->repository->save($product);
    }
}
