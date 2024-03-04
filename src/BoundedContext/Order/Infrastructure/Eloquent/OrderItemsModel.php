<?php

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductModel;

class OrderItemsModel extends Model
{
    use  HasFactory;

    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'

    ];

    public function orderId(): BelongsTo
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }

    public function productId(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
