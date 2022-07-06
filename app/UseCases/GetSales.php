<?php

namespace App\UseCases;

use App\UseCases\Contracts\SaleRepository;

class GetSales
{
    private SaleRepository $saleRepository;
    function __construct(
        SaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function get()
    {
        return $this->saleRepository->getAll();
    }
}
