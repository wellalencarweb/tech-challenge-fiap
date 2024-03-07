<?php

declare(strict_types=1);

namespace Src\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ProductAdapter;
use Src\Gateways\Product\ProductGateway;
use Src\UseCases\Product\GetProductUseCase;


final class GetProductController
{
    public function __construct(
        private ProductGateway $gateway,
        private ProductAdapter $productAdapter
    ){
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): Response
    {
        $productId = (int)$request->id;

        $getProductUseCase = new GetProductUseCase($this->gateway);
        $productData = $getProductUseCase->__invoke($productId);

        if (!$productData) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => 'product not found'],
                    Response::HTTP_NOT_FOUND
                );
        }

        return $this->productAdapter->adaptJsonClients($productData, Response::HTTP_OK);

    }
}
