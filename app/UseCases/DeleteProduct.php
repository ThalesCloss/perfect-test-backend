<?php

namespace App\UseCases;

use App\Entities\Product;
use App\Repositories\EloquentRepositories\EloquentProductRepository;
use App\Repositories\MemoryRepositories\MemoryProductRepository;
use App\UseCases\Contracts\ProductRepository;

class DeleteProduct
{

    private ProductRepository $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }
}
