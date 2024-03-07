<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Product\GetProductController;


class GetProductControllerApi extends Controller
{

    public function __construct(
        private GetProductController $getProductController
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
        return $this->getProductController->__invoke($request);
    }
}
