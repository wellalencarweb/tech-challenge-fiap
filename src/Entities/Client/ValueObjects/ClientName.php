<?php

declare(strict_types=1);

namespace Src\Entities\Client\ValueObjects;

final class ClientName
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
