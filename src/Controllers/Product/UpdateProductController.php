<?php

declare(strict_types=1);

namespace Src\Controllers\Product;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ProductAdapter;
use Src\Gateways\Product\ProductGateway;
use Src\UseCases\Product\GetProductUseCase;
use Src\UseCases\Product\UpdateProductUseCase;


final class UpdateProductController
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
        try {
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

            $productName            = $request->input('name') ?? $product->name()->value();
            $productDescription     = $request->input('description') ?? $product->description()->value();
            $productPrice           = (float) $request->input('price') ?? $product->price()->value();
            $productCategoryId      = (int) $request->input('category_id') ?? $product->categoryId()->value();
            $productActive          = (bool) $request->input('active') ?? $product->active()->value();


            $updateProductUseCase = new UpdateProductUseCase($this->gateway);
            $updateProductUseCase->__invoke(
                $productId,
                $productName,
                $productDescription,
                $productPrice,
                $productCategoryId,
                $productActive
            );

            $productData = $getProductUseCase->__invoke($productId);
            return $this->productAdapter->adaptJsonClients($productData, Response::HTTP_OK);
        } catch (QueryException $e) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    [
                        'status' => 'error',
                        'message' => 'Error processing the request. Please try again.'
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        } catch (\Exception $e) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    ['error' => $e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
