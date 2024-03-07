<?php

namespace  Src\Entities\Products\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self SNACK()
 * @method static self ACCOMPANIMENT()
 * @method static self DRINK()
 */
class ProductCategoryEnum extends Enum
{
    public static function values()
    {
        return [
            'SNACK' => 1,
            'ACCOMPANIMENT' => 2,
            'DRINK' => 3,
        ];
    }
}

