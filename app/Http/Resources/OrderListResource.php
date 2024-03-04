<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class OrderListResource extends JsonResource
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

        foreach ($resource as $order) {
            $orderId = $order['id'];

            if (!isset($data['data'][$orderId])) {
                $data['data'][$orderId] = $this->mapDomainOrderList($order);
            }

            $data['data'][$orderId]['products'][] = $this->mapDomainProduct($order);
        }

        return array_values($data['data']);
    }

    public function mapDomainOrderList(array $order): array
    {
        return [
            'id' => $order['id'],
            'status' => $order['order_status_description'],
            'client' => $order['client_name'],
            'client_email' => $order['client_email'],
            'client_cpf' => $order['client_cpf'],
            'products' => [],
        ];
    }

    public function mapDomainProduct(array $order): array
    {
        return [
            'product_name' => $order['product_name'],
            'product_description' => $order['product_description'],
            'product_price' => $order['product_price'],
            'quantity' => $order['quantity'],
        ];
    }
}
