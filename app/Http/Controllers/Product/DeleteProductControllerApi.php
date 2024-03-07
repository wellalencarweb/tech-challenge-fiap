<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Controllers\Product\DeleteProductController;


class DeleteProductControllerApi extends Controller
{
    public function __construct(
        private DeleteProductController $deleteProductController
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
        return $this->deleteProductController->__invoke($request);
    }
}
