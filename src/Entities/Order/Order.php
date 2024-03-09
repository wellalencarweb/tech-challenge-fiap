<?php

declare(strict_types=1);

namespace Src\Entities\Order;

use JetBrains\PhpStorm\Pure;
use Src\Entities\Order\ValueObjects\OrderClientId;
use Src\Entities\Order\ValueObjects\OrderId;

final class Order
{
    public function __construct(
        private OrderId $id,
        private OrderClientId $clientId,
        private array $products,
        private int $status,

    )
    {
    }

    public function id(): OrderId
    {
        return $this->id;
    }

    public function clientId(): OrderClientId
    {
        return $this->clientId;
    }

    public function products(): array
    {
        return $this->products;
    }

    public function status(): int
    {
        return $this->status;
    }

    #[Pure]
    public static function create(
        OrderId $id,
        OrderClientId $clientId,
        array $products,
        int $status
    ): Order
    {
        return new self($id, $clientId, $products, $status);
    }
}
