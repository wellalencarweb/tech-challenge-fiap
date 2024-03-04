<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

final class ProductActive
{
    private bool $value;

    public function __construct(bool $active)
    {
        $this->value = $active;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
