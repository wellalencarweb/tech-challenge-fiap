<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Product\Infrastructure\DeleteProductController as DeleteProductControllerInfra;

class DeleteProductController extends Controller
{
    private DeleteProductControllerInfra $deleteProductControllerInfra;

    public function __construct(DeleteProductControllerInfra $deleteProductControllerInfra)
    {
        $this->deleteProductControllerInfra = $deleteProductControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $productData = $this->deleteProductControllerInfra->__invoke($request);

        if (!$productData) {
            return response(['status' => 'error', 'message' => 'product not found'],  Response::HTTP_NOT_FOUND);
        }

        return response([], Response::HTTP_NO_CONTENT);

    }
}
