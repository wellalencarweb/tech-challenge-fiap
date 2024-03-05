<?php

declare(strict_types=1);

namespace Src\UseCases\Client;

use Src\Entities\Client\ValueObjects\ClientCpf;
use Src\Entities\Client\ValueObjects\ClientEmail;
use Src\Entities\Client\ValueObjects\ClientName;
use Src\Interfaces\Client\ClientGatewayInterface;

final class GetClientByCriteriaUseCase
{
    public function __construct(
        private ClientGatewayInterface $gateway
    ){
    }

    public function __invoke(
        ?string $clientName,
        ?string $clientEmail,
        ?string $clientCpf
    ): array
    {
        $name   = new ClientName($clientName);
        $email  = new ClientEmail($clientEmail);
        $cpf    = new ClientCpf($clientCpf);

        return $this->gateway->findByCriteria($name, $email, $cpf);
    }
}
