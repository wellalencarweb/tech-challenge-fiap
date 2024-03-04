<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\Contracts;

use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCpf;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductEmail;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;

interface ProductRepositoryContract
{
    public function find(ProductId $id): ?Product;

    //public function findByCriteria(ProductName $productName, ProductEmail $productEmail, ProductCpf $productCpf): array;

    public function save(Product $product): Product;

    public function update(Product $product): void;

    public function delete(ProductId $id): void;
}
