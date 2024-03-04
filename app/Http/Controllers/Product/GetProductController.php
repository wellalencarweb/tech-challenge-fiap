<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Product\Infrastructure\GetProductController as GetProductControllerInfra;

class GetProductController extends Controller
{

    private GetProductControllerInfra $getProductControllerInfra;

    public function __construct(GetProductControllerInfra $getProductControllerInfra)
    {
        $this->getProductControllerInfra = $getProductControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $productData = $this->getProductControllerInfra->__invoke($request);

        if (!$productData) {
            return response(['status' => 'error', 'message' => 'product not found'],  Response::HTTP_NOT_FOUND);
        }

        $product = new ProductResource($productData);
        return response($product, Response::HTTP_OK);
    }
}
