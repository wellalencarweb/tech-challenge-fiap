<?php

namespace Src\Adapters;



use Illuminate\Http\Response;

class OrderListAdapter
{
    /**
     * Transform the resource into an array.
     *
     * @param array  $request
     * @return array
     */
    public function toArray(array $request)
    {
        $data = ['data' => []];
        $resource = $request;

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

    public function adaptJsonClients(array $data, $statusCode): Response
    {
        $data = $this->toArray($data);
        return response($data, $statusCode);
    }

    public function adaptJsonMessageError(array $message, $statusCode): Response
    {
        return response($message ?? ['message-error-default'], $statusCode);
    }
}
