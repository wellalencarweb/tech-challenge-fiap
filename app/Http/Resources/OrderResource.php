<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Order\Domain\Enums\OrderStatusEnum;
use Src\BoundedContext\Order\Domain\Order;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {

        $data = ['data' => []];

        $resource = $this->resource;

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
}
