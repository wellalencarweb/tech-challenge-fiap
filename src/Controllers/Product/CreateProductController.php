<?php

declare(strict_types=1);

namespace Src\Controllers\Product;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Adapters\ProductAdapter;
use Src\Controllers\Exceptions\ValidationException;
use Src\Gateways\Product\ProductGateway;
use Src\UseCases\Product\CreateProductUseCase;

final class CreateProductController
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
            $productName            = $request->input('name');
            $productDescription     = $request->input('description');
            $productPrice           = (float) $request->input('price');
            $productCategoryId      = (int) $request->input('category_id');

            $createProductUseCase = new CreateProductUseCase($this->gateway);

            $productData =  $createProductUseCase->__invoke(
                $productName,
                $productDescription,
                $productPrice,
                $productCategoryId
            );
            return $this->productAdapter->adaptJsonClients($productData, Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return $this->productAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
                );
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
