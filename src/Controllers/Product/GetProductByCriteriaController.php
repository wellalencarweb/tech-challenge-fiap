<?php

declare(strict_types=1);

namespace Src\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ProductAdapter;
use Src\Gateways\Product\ProductGateway;
use Src\UseCases\Product\GetProductByCriteriaUseCase;


final class GetProductByCriteriaController
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
            $productCategory = $request->input('category') ?? null;

            $getProductByCriteriaUseCase = new GetProductByCriteriaUseCase($this->gateway);
            $productsData = $getProductByCriteriaUseCase->__invoke($productCategory);

            if (!$productsData) {
                return $this->productAdapter
                    ->adaptJsonMessageError(
                        ['status' => 'error', 'message' => 'product not found'],
                        Response::HTTP_NOT_FOUND
                    );
            }
            return $this->productAdapter->adaptJsonClients($productsData, Response::HTTP_OK);
        } catch (\InvalidArgumentException $e) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
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
