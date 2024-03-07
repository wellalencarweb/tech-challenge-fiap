<?php

declare(strict_types=1);

namespace Src\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ProductAdapter;
use Src\Gateways\Product\ProductGateway;
use Src\UseCases\Product\DeleteProductUseCase;
use Src\UseCases\Product\GetProductUseCase;

final class DeleteProductController
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
        $product           = $getProductUseCase->__invoke($productId);

        if (!$product) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => 'product not found'],
                    Response::HTTP_NOT_FOUND
                );
        }

        $deleteProductUseCase = new DeleteProductUseCase($this->gateway);
        $deleteProductUseCase->__invoke($productId);

        return $this->productAdapter->adaptJsonClients([], Response::HTTP_NO_CONTENT);
    }
}
