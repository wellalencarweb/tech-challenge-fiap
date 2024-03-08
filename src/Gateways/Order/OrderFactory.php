<?php

namespace Src\Gateways\Order;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;


class OrderFactory extends Factory
{
    protected $model = OrderModel::class;

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
