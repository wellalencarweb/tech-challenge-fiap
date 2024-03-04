<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Domain\ValueObjects;

use DateTime;

final class ClientEmailVerifiedDate
{
    private $value;

    public function __construct(?DateTime $emailVerifiedDate)
    {
        $this->value = $emailVerifiedDate;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
