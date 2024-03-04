<?php

namespace Src\Gateways\Client;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;


class ClientFactory extends Factory
{
    protected $model = ClientModel::class;

    #[ArrayShape(['name' => "string", 'email' => "string"])]
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->numerify('###########')
        ];
    }
}
