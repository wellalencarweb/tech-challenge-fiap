<?php

declare(strict_types=1);

namespace Src\UseCases\Product;

use Src\Interfaces\Product\ProductGatewayInterface;

final class GetProductByCriteriaUseCase
{
    public function __construct(
        private ProductGatewayInterface $gateway
    ){
    }

    public function __invoke(
        ?string $productCategory
    ): array
    {
        //Todo: implementar ValueObject para $productCategory
        return $this->gateway->findByCriteria($productCategory);
    }
}
