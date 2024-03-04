<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure\Eloquent;

use Src\BoundedContext\Client\Infrastructure\Eloquent\ClientModel as EloquentClientModel;
use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientCpf;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;


final class EloquentClientRepository implements ClientRepositoryContract
{
    private EloquentClientModel $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentClientModel;
    }

    public function find(ClientId $id): ?Client
    {
        $client = $this->eloquentClientModel->find($id->value());

        return $this->createDomainClientModel($client);
    }


    public function findByCriteria(?ClientName $clientName, ?ClientEmail $clientEmail, ?ClientCpf $clientCpf): array
    {
        $clients = [];

        $search = $this->eloquentClientModel->newQuery();

        if (!is_null($clientName->value())) {
            $search->where('name', $clientName->value());
        }

        if (!is_null($clientEmail->value())) {
            $search->where('email', $clientEmail->value());
        }

        if (!is_null($clientCpf->value())) {
            $search->where('cpf', $clientCpf->value());
        }

        $clientsList = $search->get();

        foreach ($clientsList as $client){
            $clients[] = $this->createDomainClientModel($client);
        }

        return $clients;
    }

    public function save(Client $client): Client
    {
        $newClient = $this->eloquentClientModel;

        $data = [
            'name' => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf' => $client->cpf()->value(),
        ];

        $client = $newClient->create($data);

        return $this->createDomainClientModel($client);
    }

    public function update(Client $client): void
    {
        $clientToUpdate = $this->eloquentClientModel;

        $data = [
            'name'  => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf'   => $client->cpf()->value(),
        ];

        $clientToUpdate
            ->findOrFail($client->id()->value())
            ->update($data);
    }

    public function delete(ClientId $id): void
    {
        $this->eloquentClientModel
            ->findOrFail($id->value())
            ->delete();
    }

    private function createDomainClientModel(?ClientModel $client): ?Client
    {
        if (!$client) {
            return null;
        }

        return new Client(
            new ClientId($client->id),
            new ClientName($client->name),
            new ClientEmail($client->email),
            new ClientCpf($client->cpf)
        );
    }
}
