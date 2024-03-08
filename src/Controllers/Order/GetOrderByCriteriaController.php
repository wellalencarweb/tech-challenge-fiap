<?php

declare(strict_types=1);

namespace Src\Controllers\Order;

use Illuminate\Http\Request;
use Src\Adapters\OrderListAdapter;
use Src\Gateways\Order\OrderGateway;
use Illuminate\Http\Response;
use Src\UseCases\Order\GetOrderByCriteriaUseCase;

final class GetOrderByCriteriaController
{
    public function __construct(
        private OrderGateway $gateway,
        private OrderListAdapter $orderListAdapter
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): Response
    {
        try {
            $orderStatus  = $request->input('status') ?? null;

            $getOrderByCriteriaUseCase = new GetOrderByCriteriaUseCase($this->gateway);
            $ordersData = $getOrderByCriteriaUseCase->__invoke($orderStatus);

            if (!$ordersData) {
                return $this->orderListAdapter
                    ->adaptJsonMessageError(
                        ['status' => 'error', 'message' => 'order not found'],
                        Response::HTTP_NOT_FOUND
                    );
           }
            return $this->orderListAdapter->adaptJsonClients($ordersData, Response::HTTP_OK);
        } catch (\InvalidArgumentException $e) {
            return $this->orderListAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
                );
        } catch (\Exception $e) {
            return $this->orderListAdapter
                ->adaptJsonMessageError(
                    ['error' => $e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }

    }
}
