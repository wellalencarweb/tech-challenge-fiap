<?php

namespace Src\Adapters;

use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Src\Entities\Client\Client;


class ClientAdapter
{
    /**
     * Transform the resource into an array.
     *
     * @param array | Client   $request
     * @return array
     */
    public function toArray(array | Client $request)
    {

        $data = ['data' => []];

        $resource = $request;

        if ($resource instanceof Client) {
            $data['data'][] = $this->mapDomainClient($resource);
        }

        foreach ($resource as $client) {
            $data['data'][] = $this->mapDomainClient($client);
        }

        return $data;
    }


    #[Pure]
    #[ArrayShape(['name' => "null|string", 'email' => "null|string", 'cpf' => "null|string"])]
    public function mapDomainClient(Client $client): array
    {
        return [
            'id' => $client->id()->value(),
            'name' => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf' => $client->cpf()->value()
        ];
    }

    public function adaptJsonClients(array | Client $data, $statusCode): Response
    {
        $data = $this->toArray($data);
        return response($data, $statusCode);
    }

    public function adaptJsonMessageError(array $message, $statusCode): Response
    {
        return response($message ?? ['message-error-default'], $statusCode);
    }
}
