<?php

declare(strict_types=1);

namespace  Src\Entities\Product\ValueObjects;

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
