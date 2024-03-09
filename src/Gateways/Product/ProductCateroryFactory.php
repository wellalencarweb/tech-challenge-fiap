<?php

namespace Src\Gateways\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Entities\Product\Enums\ProductCategoryEnum;


class ProductCateroryFactory extends Factory
{
    protected $model = ProductCategoryModel::class;

    public function definition(): array
    {
        $description = array_rand(ProductCategoryEnum::values());
        $id = ProductCategoryEnum::values()[$description];

        return [
            'id' => $id,
            'description' => $description,
        ];
    }
}
