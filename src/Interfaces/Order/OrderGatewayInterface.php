<?php

declare(strict_types=1);

namespace Src\Interfaces\Order;


use Src\Entities\Order\Order;
use Src\Entities\Order\ValueObjects\OrderId;

interface OrderGatewayInterface
{
    public function find(OrderId $id): ?Order;

    public function findByCriteria(?string $orderStatus): array;

    public function save(Order $order): Order;

    public function update(Order $order): void;

    public function delete(OrderId $id): void;
}
