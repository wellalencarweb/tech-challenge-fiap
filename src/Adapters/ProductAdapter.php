<?php

namespace Src\Adapters;


use Illuminate\Http\Response;
use Src\Entities\Product\Enums\ProductCategoryEnum;
use Src\Entities\Product\Product;

class ProductAdapter
{
    /**
     * Transform the resource into an array.
     *
     * @param array | Product  $request
     * @return array
     */
    public function toArray(array | Product $request)
    {
        $data = ['data' => []];

        $resource = $request;

        if ($resource instanceof Product) {
            $data['data'][] = $this->mapDomainProduct($resource);
        }

        foreach ($resource as $product) {
            $data['data'][] = $this->mapDomainProduct($product);
        }

        return $data;
    }


    public function mapDomainProduct(Product $product): array
    {
        return [
            'id' => $product->id()->value(),
            'name' => $product->name()->value(),
            'description' => $product->description()->value(),
            'price' => $product->price()->value(),
            'category' => ProductCategoryEnum::from($product->categoryId()->value())->label,
            'active' => $product->active()->value()
        ];
    }

    public function adaptJsonClients(array | Product $data, $statusCode): Response
    {
        $data = $this->toArray($data);
        return response($data, $statusCode);
    }

    public function adaptJsonMessageError(array $message, $statusCode): Response
    {
        return response($message ?? ['message-error-default'], $statusCode);
    }
}
