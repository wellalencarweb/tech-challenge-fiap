<?php

declare(strict_types=1);

namespace Src\UseCases\Product;


use Src\Entities\Product\Product;
use Src\Entities\Product\ValueObjects\ProductActive;
use Src\Entities\Product\ValueObjects\ProductCategoryId;
use Src\Entities\Product\ValueObjects\ProductDescription;
use Src\Entities\Product\ValueObjects\ProductId;
use Src\Entities\Product\ValueObjects\ProductName;
use Src\Entities\Product\ValueObjects\ProductPrice;
use Src\Interfaces\Product\ProductGatewayInterface;

final class UpdateProductUseCase
{
    public function __construct(
        private ProductGatewayInterface $gateway
    ){
    }

    public function __invoke(
        int     $productId,
        string  $productName,
        string  $productDescription,
        float   $productPrice,
        int     $productCategoryId,
        bool    $productActive
    ): void
    {
        $id             = new ProductId($productId);
        $name           = new ProductName($productName);
        $description    = new ProductDescription($productDescription);
        $price          = new ProductPrice($productPrice);
        $categoryId     = new ProductCategoryId($productCategoryId);
        $active         = new ProductActive($productActive);

        $product = Product::create($id,
            $name,
            $description,
            $price,
            $categoryId,
            $active
        );

        $this->gateway->update($product);
    }
}
