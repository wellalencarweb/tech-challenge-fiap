<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\Enums\OrderStatusEnum;
use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderClientId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;

final class CreateOrderUseCase
{
    private OrderRepositoryContract $repository;

    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
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

        return $this->repository->save($order);
    }
}
