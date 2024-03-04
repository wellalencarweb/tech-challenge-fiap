<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\BoundedContext\Client\Infrastructure\Eloquent\ClientModel;
use Src\BoundedContext\Order\Domain\Enums\OrderStatusEnum;
use Src\BoundedContext\Product\Domain\Enums\ProductCategoryEnum;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ClientModel::newFactoryTimes(1)->create(['cpf' => '95162320005']);

        foreach(ProductCategoryEnum::values() as $key => $id) {
            DB::table('product_categories')->updateOrInsert([
                'id' => $id,
                'description' => $key,
            ]);
        }

        foreach(OrderStatusEnum::values() as $key => $id) {
            DB::table('order_status')->updateOrInsert([
                'id' => $id,
                'description' => $key,
            ]);
        }


        ProductModel::newFactoryTimes(1)
            ->create([
                'name' => 'Big Tasty',
                'description' => "Um hambúrguer (100% carne bovina)",
                'category_id' => ProductCategoryEnum::SNACK()->value
            ]);

        ProductModel::newFactoryTimes(1)
            ->create([
                'name' => 'Fritas Cheddar Bacon',
                'description' => "A batata frita mais famosa do mundo, agora com melt sabor cheddar e bacon crispy",
                'category_id' => ProductCategoryEnum::ACCOMPANIMENT()->value
            ]);

        ProductModel::newFactoryTimes(1)
            ->create([
                'name' => 'Del Valle Uva 700ml',
                'description' => "Deliciosos sabores à sua escolha. Néctar de fruta nos sabores uva ou laranja.",
                'category_id' => ProductCategoryEnum::DRINK()->value
            ]);
    }
}
