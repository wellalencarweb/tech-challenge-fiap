<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Product\UpdateProductController;

class UpdateProductControllerApi extends Controller
{
    public function __construct(
        private UpdateProductController $updateProductController
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
        return $this->updateProductController->__invoke($request);
    }
}
