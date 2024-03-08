<?php

namespace Src\Adapters;

use Illuminate\Http\Response;
use Src\Entities\Order\Enums\OrderStatusEnum;
use Src\Entities\Order\Order;


class OrderAdapter
{
    /**
     * Transform the resource into an array.
     *
     * @param array | Order   $request
     * @return array
     */
    public function toArray(array | Order $request)
    {

        $data = ['data' => []];

        $resource = $request;

        if ($resource instanceof Order) {
            $data['data'][] = $this->mapDomainOrder($resource);
        }

        foreach ($resource as $order) {
            $data['data'][] = $this->mapDomainOrder($order);
        }

        return $data;
    }


    public function mapDomainOrder(Order $order): array
    {
        $productsWithoutPrice = collect($order->products())->map(function ($product) {
            unset($product['price']);
            return $product;
        });

        return [
            'id' => $order->id()->value(),
            'client_id' => $order->clientId()->value(),
            'products' => $productsWithoutPrice,
            'status' => OrderStatusEnum::from($order->status())->label,
        ];
    }

    public function adaptJsonClients(array | Order $data, $statusCode): Response
    {
        $data = $this->toArray($data);
        return response($data, $statusCode);
    }

    public function adaptJsonMessageError(array $message, $statusCode): Response
    {
        return response($message ?? ['message-error-default'], $statusCode);
    }
}
