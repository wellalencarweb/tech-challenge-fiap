<?php

declare(strict_types=1);

namespace Src\BoundedContext\Order\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Order\Application\GetOrderByCriteriaUseCase;
use Src\BoundedContext\Order\Infrastructure\Eloquent\EloquentOrderRepository;

final class GetOrderByCriteriaController
{
    private EloquentOrderRepository $repository;

    public function __construct(EloquentOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $orderStatus  = $request->input('status') ?? null;

        $getOrderByCriteriaUseCase = new GetOrderByCriteriaUseCase($this->repository);
        return $getOrderByCriteriaUseCase->__invoke($orderStatus);
    }
}
