<?php

namespace App\UseCases;

use App\UseCases\Contracts\ProductRepository;

class GetProduct
{

    private ProductRepository $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get($id)
    {
        return $this->repository->getById($id);
    }
}
