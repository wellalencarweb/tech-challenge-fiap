<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Domain\ValueObjects;

use InvalidArgumentException;
use Src\BoundedContext\Product\Domain\Enums\ProductCategoryEnum;

final class ProductCategoryId
{
    private int $value;

    public function __construct(int $categoryId)
    {
        $this->validate($categoryId);
        $this->value = $categoryId;
    }

    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int  $categoryId
     * @throws InvalidArgumentException
     */
    private function validate(int $categoryId): void
    {
        if (!in_array($categoryId, ProductCategoryEnum::values())) {
            throw new InvalidArgumentException(
                sprintf('<%s> Category ID not found: <%s>.', ProductCategoryId::class, $categoryId)
            );
        }
    }
}
