<?php

namespace Src\Controllers\Order\Validations;

use Src\Controllers\Exceptions\ValidationException;

class CreateOrderValidation
{
    /**
     * @throws ValidationException
     */
    public static function validate(array $data): void
    {
        $validator = validator($data, [
            'client_id' => 'required|integer',
            'products' => 'required|array',
            'products.*' => 'integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }
}
