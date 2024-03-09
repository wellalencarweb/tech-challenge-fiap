<?php

declare(strict_types=1);

namespace Src\UseCases\Order;


use Src\Entities\Order\Enums\OrderStatusEnum;
use Src\Entities\Order\Order;
use Src\Entities\Order\ValueObjects\OrderClientId;
use Src\Entities\Order\ValueObjects\OrderId;
use Src\Interfaces\Order\OrderGatewayInterface;

final class CreateOrderUseCase
{
    public function __construct(
        private OrderGatewayInterface $gateway
    ){
    }

    public function __invoke(
        int $orderClientId,
        array $orderProducts
    ): Order
    {
        $id         = new OrderId(null);
        $clientId   = new OrderClientId($orderClientId);
        //Todo: criar value object
        $products   = $orderProducts;
        $status     = OrderStatusEnum::RECEIVED()->value;

        $order = Order::create($id, $clientId, $products, $status);

        return $this->gateway->save($order);
    }
}
