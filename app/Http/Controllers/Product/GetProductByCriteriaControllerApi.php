<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Product\GetProductByCriteriaController;


class GetProductByCriteriaControllerApi extends Controller
{
    public function __construct(
        private GetProductByCriteriaController $getProductByCriteriaController
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
        return $this->getProductByCriteriaController->__invoke($request);
    }
}
