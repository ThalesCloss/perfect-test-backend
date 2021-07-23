<?php

namespace App\UseCases;

use App\Repositories\MemoryRepositories\MemoryProductRepository;
use App\UseCases\Contracts\ProductRepository;

class GetProducts
{

    private ProductRepository $repository;
    public function __construct(MemoryProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($id)
    {
        return $this->repository->getById($id);
    }
}
