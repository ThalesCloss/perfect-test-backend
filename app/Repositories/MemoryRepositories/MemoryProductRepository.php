<?php

namespace App\Repositories\MemoryRepositories;

use App\Entities\Product;
use App\Repositories\Exceptions\ProductNotFound;
use App\UseCases\Contracts\ProductRepository;

class MemoryProductRepository implements ProductRepository
{
    public $products = [];
    public function save(Product $product): void
    {
        $product->setName('up reference');
        if (!$product->getId()) {
            $this->products[sizeOf($this->products) + 1] = $product->toArray();
            return;
        };
        $this->products[$product->getId()] = $product->toArray();
    }

    public function getAll(): array
    {
        return $this->products;
    }

    public function getById(int $id): array
    {
        if (empty($this->products[$id]))
            throw new ProductNotFound("Nenhum produto foi encontrado para o localizador $id");
        return $this->products[$id];
    }

    public function delete(int $id): void
    {
        if (empty($this->products[$id]))
            throw new ProductNotFound("Nenhum produto foi encontrado para o localizador $id");
        $this->products[$id] = null;
        return;
    }
}
