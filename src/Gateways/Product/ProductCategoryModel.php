<?php

namespace Src\Gateways\Product;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model
{
    use  HasFactory;

    protected $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
    ];

    protected static function newFactoryTimes(int $count): ProductCateroryFactory
    {
        return ProductCateroryFactory::times($count);
    }
}
