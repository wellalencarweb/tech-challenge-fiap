<?php

namespace Src\Gateways\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Entities\Products\Enums\ProductCategoryEnum;


class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(100, 500) / 100,
            'category_id' => ProductCategoryEnum::SNACK()->value,
            'active' => 1
        ];
    }
}
