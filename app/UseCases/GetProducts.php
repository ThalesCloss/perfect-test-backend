<?php

namespace App\UseCases;

use App\UseCases\Contracts\ProductRepository;

class GetProducts
{

    private ProductRepository $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        return $this->repository->getAll();
    }
}
