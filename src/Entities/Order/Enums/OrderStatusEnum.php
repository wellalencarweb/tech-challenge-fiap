<?php

namespace Src\Entities\Order\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self RECEIVED()
 * @method static self PREPARING()
 * @method static self READY()
 * @method static self WAITING_ORDER_PICKUP()
 * @method static self WITHDRAWAL()
 * @method static self FINISHED()
 */
class OrderStatusEnum extends Enum
{
    public static function values()
    {
        return [
            'RECEIVED' => 1,
            'PREPARING' => 2,
            'READY' => 3,
            'WAITING_ORDER_PICKUP' => 4,
            'WITHDRAWAL' => 5,
            'FINISHED' => 6,
        ];
    }
}

