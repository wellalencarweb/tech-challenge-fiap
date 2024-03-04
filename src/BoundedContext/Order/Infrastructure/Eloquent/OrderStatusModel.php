<?php

namespace Src\BoundedContext\Order\Infrastructure\Eloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusModel extends Model
{
    use  HasFactory;

    protected $table = 'order_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
    ];
}
