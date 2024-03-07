<?php

declare(strict_types=1);

namespace  Src\Entities\Product\ValueObjects;


final class ProductDescription
{
    private string $value;

    /**
     * ProductDescription constructor.
     * @param string $description
     */
    public function __construct(string $description)
    {
        $this->value = $description;
    }

    public function value(): string
    {
        return $this->value;
    }
}
