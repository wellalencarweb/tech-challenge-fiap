<?php

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderModel extends Model
{
    use  HasFactory;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'order_status_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatusModel::class, 'order_status_id');
    }

    protected static function newFactoryTimes(int $count): OrderFactory
    {
        return OrderFactory::times($count);
    }
}
