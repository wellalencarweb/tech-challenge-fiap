<?php

declare(strict_types=1);

namespace  Src\Entities\Product\ValueObjects;

final class ProductName
{
    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}
