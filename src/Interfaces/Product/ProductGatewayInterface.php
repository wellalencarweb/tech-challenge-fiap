<?php

declare(strict_types=1);

namespace Src\Interfaces\Product;

use Src\Entities\Product\Product;
use Src\Entities\Product\ValueObjects\ProductId;

interface ProductGatewayInterface
{
    public function find(ProductId $id): ?Product;

    //public function findByCriteria(ProductName $productName): array;

    public function save(Product $product): Product;

    public function update(Product $product): void;

    public function delete(ProductId $id): void;
}
