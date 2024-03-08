<?php

declare(strict_types=1);

namespace Src\Controllers\Order;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Src\Adapters\OrderAdapter;
use Src\Controllers\Exceptions\ValidationException;
use Src\Controllers\Order\Validations\CreateOrderValidation;
use Src\Gateways\Order\OrderGateway;
use Illuminate\Http\Response;
use Src\UseCases\Order\CreateOrderUseCase;


final class CreateOrderController
{
    public function __construct(
        private OrderGateway $gateway,
        private OrderAdapter $orderAdapter
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
            CreateOrderValidation::validate($request->all());

            $orderClientId  = (int) $request->input('client_id');
            $orderProducts  = $request->input('products');


            $createOrderUseCase = new CreateOrderUseCase($this->gateway);

            $orderData = $createOrderUseCase->__invoke(
                $orderClientId,
                $orderProducts
            );

            return $this->orderAdapter->adaptJsonClients($orderData, Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            return $this->orderAdapter
                ->adaptJsonMessageError(
                    ['status' => 'error', 'message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
                );
        } catch (QueryException $e) {
            return $this->orderAdapter
                ->adaptJsonMessageError(
                    [
                        'status' => 'error',
                        'message' => 'Error processing the request. Please try again.'
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        } catch (\Exception $e) {
            return $this->orderAdapter
                ->adaptJsonMessageError(
                    ['error' => $e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
