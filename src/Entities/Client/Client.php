<?php

declare(strict_types=1);

namespace Src\Entities\Client;

use JetBrains\PhpStorm\Pure;
use Src\Entities\Client\ValueObjects\ClientCpf;
use Src\Entities\Client\ValueObjects\ClientEmail;
use Src\Entities\Client\ValueObjects\ClientId;
use Src\Entities\Client\ValueObjects\ClientName;


final class Client
{
    public function __construct(
        private ClientId $id,
        private ClientName $name,
        private ClientEmail $email,
        private ClientCpf $cpf,

    )
    {
    }

    public function id(): ClientId
    {
        return $this->id;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function email(): ClientEmail
    {
        return $this->email;
    }

    public function cpf(): ClientCpf
    {
        return $this->cpf;
    }

    #[Pure]
    public static function create(
        ClientId $id,
        ClientName $name,
        ClientEmail $email,
        ClientCpf $cpf
    ): Client
    {
        return new self($id, $name, $email, $cpf);
    }
}
