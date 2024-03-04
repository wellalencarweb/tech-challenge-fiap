<?php

declare(strict_types=1);

namespace Src\Entities\Client\ValueObjects;

use InvalidArgumentException;

final class ClientCpf
{
    private ?string $value;

    /**
     * ClientCpf constructor.
     * @param string $cpf
     * @throws InvalidArgumentException
     */
    public function __construct(?string $cpf)
    {
        if ($cpf) {
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
            $this->validate($cpf);
        }

        $this->value = $cpf;
    }

    /**
     * @param string $cpf
     * @throws InvalidArgumentException
     */
    private function validate(string $cpf): void
    {

        if (!$this->validateCpf($cpf)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid cpf: <%s>.', ClientCpf::class, $cpf)
            );
        }
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function validateCpf(string $cpf): bool
    {
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}
