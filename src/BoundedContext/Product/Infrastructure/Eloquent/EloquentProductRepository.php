<?php

declare(strict_types=1);

namespace Src\BoundedContext\Product\Infrastructure\Eloquent;

use Src\BoundedContext\Product\Domain\ValueObjects\ProductActive;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductCategoryId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductDescription;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductPrice;
use Src\BoundedContext\Product\Infrastructure\Eloquent\ProductModel as EloquentProductModel;
use Src\BoundedContext\Product\Domain\Contracts\ProductRepositoryContract;
use Src\BoundedContext\Product\Domain\Product;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductId;
use Src\BoundedContext\Product\Domain\ValueObjects\ProductName;


final class EloquentProductRepository implements ProductRepositoryContract
{
    private EloquentProductModel $eloquentProductModel;

    public function __construct()
    {
        $this->eloquentProductModel = new EloquentProductModel;
    }

    public function find(ProductId $id): ?Product
    {
        $product = $this->eloquentProductModel->find($id->value());

        return $this->createDomainProductModel($product);
    }


    public function findByCriteria(?string $productCategory): array
    {
        $products = [];

        $search = $this->eloquentProductModel->newQuery();

        $selectFields = [
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.category_id',
            'products.active',
        ];

        $search->select($selectFields);

        if (!is_null($productCategory)) {
            $search
                ->join(
                    'product_categories',
                    'products.category_id', '=', 'product_categories.id'
                )
                ->where('product_categories.description', 'LIKE', '%' . $productCategory . '%');
        }

        $productsList = $search->get();

        foreach ($productsList as $product){
            $products[] = $this->createDomainProductModel($product);
        }

        return $products;
    }

    public function save(Product $product): Product
    {
        $newProduct = $this->eloquentProductModel;

        $data = [
            'name' => $product->name()->value(),
            'description' => $product->description()->value(),
            'price' => $product->price()->value(),
            'category_id' => $product->categoryId()->value(),
            'active' => $product->active()->value()
        ];

        $product = $newProduct->create($data);

        return $this->createDomainProductModel($product);
    }

    public function update(Product $product): void
    {
        $productToUpdate = $this->eloquentProductModel;

        $data = [
            'name' => $product->name()->value(),
            'description' => $product->description()->value(),
            'price' => $product->price()->value(),
            'category_id' => $product->categoryId()->value(),
            'active' => $product->active()->value()
        ];

        $productToUpdate
            ->findOrFail($product->id()->value())
            ->update($data);
    }

    public function delete(ProductId $id): void
    {
        $this->eloquentProductModel
            ->findOrFail($id->value())
            ->delete();
    }

    private function createDomainProductModel(?ProductModel $product): ?Product
    {
        if (!$product) {
            return null;
        }

        return new Product(
            new ProductId($product->id),
            new ProductName($product->name),
            new ProductDescription($product->description),
            new ProductPrice($product->price),
            new ProductCategoryId($product->category_id),
            new ProductActive((bool) $product->active),
        );
    }
}
