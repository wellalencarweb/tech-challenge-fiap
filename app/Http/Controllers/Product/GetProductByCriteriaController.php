<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Product\Infrastructure\GetProductByCriteriaController as GetProductByCriteriaControllerInfra;

class GetProductByCriteriaController extends Controller
{

    private GetProductByCriteriaControllerInfra $getProductByCriteriaController;

    public function __construct(GetProductByCriteriaControllerInfra $getProductByCriteriaController)
    {
        $this->getProductByCriteriaController = $getProductByCriteriaController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $productsData = $this->getProductByCriteriaController->__invoke($request);

        if (!$productsData) {
            return response(['status' => 'error', 'message' => 'product not found'],  Response::HTTP_NOT_FOUND);
        }

        $products = new ProductResource($productsData);
        return response($products, Response::HTTP_OK);
    }
}
