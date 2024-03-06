<?php

declare(strict_types=1);

namespace Src\UseCases\Product;


use Src\Entities\Product\ValueObjects\ProductId;
use Src\Interfaces\Product\ProductGatewayInterface;

final class DeleteProductUseCase
{
    public function __construct(
        private ProductGatewayInterface $gateway
    ){
    }

    public function __invoke(int $productId): void
    {
        $id = new ProductId($productId);

        $this->gateway->delete($id);
    }
}
