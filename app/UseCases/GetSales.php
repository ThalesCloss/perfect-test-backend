<?php

namespace App\UseCases;

use App\Repositories\EloquentRepositories\EloquentSaleRepository;
use App\UseCases\Contracts\SaleRepository;

class GetSales
{
    private SaleRepository $saleRepository;
    function __construct(
        EloquentSaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function get()
    {
        return $this->saleRepository->getAll();
    }
}
