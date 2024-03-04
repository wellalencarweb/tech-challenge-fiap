<?php

namespace Src\BoundedContext\Order\Application\Validations;
use Src\BoundedContext\Order\Application\Exceptions\ValidationException;

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
