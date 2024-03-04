<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

final class OrderName
{
    private ?string $value;

    public function __construct(?string $name)
    {
        $this->value = $name;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
