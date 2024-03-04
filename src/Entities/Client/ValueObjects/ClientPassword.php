<?php

declare(strict_types=1);

namespace Src\Entities\Client\ValueObjects;

final class ClientPassword
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
