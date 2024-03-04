<?php

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Src\BoundedContext\Product\Domain\Enums\ProductCategoryEnum;


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
