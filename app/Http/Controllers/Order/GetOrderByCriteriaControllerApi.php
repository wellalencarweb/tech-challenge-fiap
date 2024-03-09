<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Src\Controllers\Order\GetOrderByCriteriaController;

class GetOrderByCriteriaControllerApi extends Controller
{
    public function __construct(
        private GetOrderByCriteriaController $getOrderByCriteriaController
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->getOrderByCriteriaController->__invoke($request);
    }
}
