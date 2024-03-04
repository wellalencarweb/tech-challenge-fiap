<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Order\Infrastructure\GetOrderByCriteriaController as GetOrderByCriteriaControllerInfra;

class GetOrderByCriteriaController extends Controller
{

    private GetOrderByCriteriaControllerInfra $getOrderByCriteriaController;

    public function __construct(GetOrderByCriteriaControllerInfra $getOrderByCriteriaController)
    {
        $this->getOrderByCriteriaController = $getOrderByCriteriaController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $ordersData = $this->getOrderByCriteriaController->__invoke($request);

        if (!$ordersData) {
            return response(['status' => 'error', 'message' => 'order not found'],  Response::HTTP_NOT_FOUND);
        }

        $orders = new OrderListResource($ordersData);
        return response($orders, Response::HTTP_OK);
    }
}
