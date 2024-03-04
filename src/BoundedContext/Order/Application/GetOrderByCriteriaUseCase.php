<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Application;

use Src\BoundedContext\Order\Domain\Contracts\OrderRepositoryContract;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderCpf;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderEmail;
use Src\BoundedContext\Order\Domain\ValueObjects\OrderName;

final class GetOrderByCriteriaUseCase
{
    private OrderRepositoryContract $repository;

    public function __construct(OrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?string $orderStatus
    ): array
    {
        //Todo: implementar ValueObject para $orderStatus
        return $this->repository->findByCriteria($orderStatus);
    }
}
