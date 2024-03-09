<?php

declare(strict_types=1);

namespace Src\UseCases\Order;


use Src\Interfaces\Order\OrderGatewayInterface;

final class GetOrderByCriteriaUseCase
{
    public function __construct(
        private OrderGatewayInterface $gateway
    ){
    }

    public function __invoke(
        ?string $orderStatus
    ): array
    {
        //Todo: implementar ValueObject para $orderStatus
        return $this->gateway->findByCriteria($orderStatus);
    }
}
