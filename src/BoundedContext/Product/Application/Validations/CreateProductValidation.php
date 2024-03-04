<?php

namespace Src\BoundedContext\Product\Application\Validations;
use Src\BoundedContext\Product\Application\Exceptions\ValidationException;

class CreateProductValidation
{
    /**
     * @throws ValidationException
     */
    public static function validate(array $data): void
    {
        $validator = validator($data, [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:500',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
    }
}
