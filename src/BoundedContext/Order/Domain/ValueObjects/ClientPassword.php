<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Domain\ValueObjects;

final class OrderPassword
{
    private $value;

    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
