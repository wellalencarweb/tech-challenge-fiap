<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain;

use JetBrains\PhpStorm\Pure;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductActive;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCategoryId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductPrice;


final class Product
{
    public function __construct(
        private ProductId $id,
        private ProductName $name,
        private ProductDescription $description,
        private ProductPrice $price,
        private ProductCategoryId $categoryId,
        private ProductActive $active
    )
    {
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }

    public function categoryId(): ProductCategoryId
    {
        return $this->categoryId;
    }

    public function active(): ProductActive
    {
        return $this->active;
    }

    #[Pure]
    public static function create(
        ProductId $id,
        ProductName $name,
        ProductDescription $description,
        ProductPrice $price,
        ProductCategoryId $categoryId,
        ProductActive $active
    ): Product
    {
        return new self($id, $name, $description, $price, $categoryId, $active);
    }
}
