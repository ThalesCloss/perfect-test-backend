<?php

namespace App\Repositories\EloquentRepositories;

use App\Entities\Product;
use App\Models\Product as ProductModel;
use App\Repositories\Exceptions\ProductNotFound;
use App\UseCases\Contracts\ProductRepository;

class EloquentProductRepository implements ProductRepository
{
    function save(Product $product): void
    {
        if (empty($product->getId())) {
            $this->insert($product);
            return;
        }

        $productModel = $this->getModelById($product->getId());
        if (empty($productModel))
            throw new ProductNotFound("Não foi possível localizar o produto {$product->getId()}");

        $this->update($productModel, $product);
        return;
    }

    private function insert(Product $product)
    {
        ProductModel::create($product->toArray());
        return;
    }

    private function update(ProductModel $productModel, Product $product)
    {
        $productModel->fill($product->toArray());
        $productModel->save();
        return;
    }

    private function getModelById(int $id)
    {
        return ProductModel::find($id);
    }

    function delete(int $id): void
    {
        $productDelete = $this->getModelById($id);
        if (!empty($productDelete))
            $productDelete->delete();
        return;
    }
    function getById(int $id): array
    {
        $product = $this->getModelById($id);
        return $product ? $product->toArray() : [];
    }
    function getAll(): array
    {
        $products = ProductModel::all();
        return !empty($products) ? $products->toArray() : [];
    }
}
