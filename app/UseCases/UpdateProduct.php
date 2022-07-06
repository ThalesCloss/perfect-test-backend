<?php

namespace App\UseCases;

use App\Entities\Product;
use App\UseCases\Contracts\ProductRepository;
use App\UseCases\Contracts\SaleRepository;

class UpdateProduct
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(array $product, int $id)
    {
        $updatedProduct = Product::fromArray($product, $id);
        $this->repository->save($updatedProduct);
    }
}
