<?php

namespace App\UseCases;

use App\Repositories\EloquentRepositories\EloquentSaleRepository;
use App\UseCases\Contracts\SaleRepository;

class GetSale
{
    private SaleRepository $saleRepository;
    function __construct(
        EloquentSaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function get(int $id)
    {
        return $this->saleRepository->getById($id);
    }
}
