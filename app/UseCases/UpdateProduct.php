<?php

namespace App\UseCases;

use App\Entities\Product;
use App\Repositories\MemoryRepositories\MemoryProductRepository;
use App\UseCases\Contracts\ProductRepository;

class UpdateProduct
{
    private ProductRepository $repository;

    public function __construct(MemoryProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(array $product, int $id)
    {
        $updatedProduct = Product::fromArray($product, $id);
        $this->repository->save($updatedProduct);
    }
}
