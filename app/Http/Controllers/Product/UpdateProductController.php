<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\BoundedContext\Product\Infrastructure\UpdateProductController as UpdateProductControllerInfra;

class UpdateProductController extends Controller
{
    private UpdateProductControllerInfra $updateProductControllerInfra;

    public function __construct(UpdateProductControllerInfra $updateProductControllerInfra)
    {
        $this->updateProductControllerInfra = $updateProductControllerInfra;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $productData = $this->updateProductControllerInfra->__invoke($request);

        if (!$productData) {
            return response(['status' => 'error', 'message' => 'product not found'],  Response::HTTP_NOT_FOUND);
        }

        $updatedProduct = new ProductResource($productData);
        return response($updatedProduct, Response::HTTP_OK);
    }
}
