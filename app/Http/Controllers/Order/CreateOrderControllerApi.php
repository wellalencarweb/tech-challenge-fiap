<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Src\Controllers\Order\CreateOrderController;

class CreateOrderControllerApi extends Controller
{
    public function __construct(
        private CreateOrderController $createOrderController
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
        return $this->createOrderController->__invoke($request);
    }
}
