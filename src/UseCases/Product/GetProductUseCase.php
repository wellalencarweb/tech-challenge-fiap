<?php

declare(strict_types=1);

namespace Src\UseCases\Product;


use Src\Entities\Product\Product;
use Src\Entities\Product\ValueObjects\ProductId;
use Src\Interfaces\Product\ProductGatewayInterface;

final class GetProductUseCase
{
    public function __construct(
        private ProductGatewayInterface $gateway
    ){
    }

    public function __invoke(int $productId): ?Product
    {
        $id = new ProductId($productId);

        return $this->gateway->find($id);
    }
}
