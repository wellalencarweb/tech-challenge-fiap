<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\Contracts;

use Src\BoundedContext\Order\Domain\Order;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderId;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;

interface OrderRepositoryContract
{
    public function find(OrderId $id): ?Order;

    public function findByCriteria(?string $orderStatus): array;

    public function save(Order $order): Order;

    public function update(Order $order): void;

    public function delete(OrderId $id): void;
}
