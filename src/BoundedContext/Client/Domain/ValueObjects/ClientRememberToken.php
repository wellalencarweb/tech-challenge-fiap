<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain\ValueObjects;

final class ClientRememberToken
{
    private $value;

    public function __construct(?string $rememberToken)
    {
        $this->value = $rememberToken;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
