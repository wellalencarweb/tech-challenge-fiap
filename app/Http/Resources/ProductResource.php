<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Src\BoundedContext\Product\Domain\Enums\ProductCategoryEnum;
use Src\BoundedContext\Product\Domain\Product;

class ProductResource extends JsonResource
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
}
