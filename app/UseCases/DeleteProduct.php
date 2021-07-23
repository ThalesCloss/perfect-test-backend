<?php

namespace App\UseCases;

use App\Entities\Product;
use App\Repositories\MemoryRepositories\MemoryProductRepository;
use App\UseCases\Contracts\ProductRepository;

class CreateProduct
{

    private ProductRepository $repository;
    public function __construct(MemoryProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }
}
