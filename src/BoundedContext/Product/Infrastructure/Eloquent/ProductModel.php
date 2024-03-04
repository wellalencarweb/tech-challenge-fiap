<?php

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductModel extends Model
{
    use  HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'active'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryModel::class, 'category_id');
    }

    protected static function newFactoryTimes(int $count): ProductFactory
    {
        return ProductFactory::times($count);
    }
}
