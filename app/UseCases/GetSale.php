<?php

namespace App\UseCases;

use App\UseCases\Contracts\SaleRepository;

class GetSale
{
    private SaleRepository $saleRepository;
    function __construct(
        SaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function get(int $id)
    {
        return $this->saleRepository->getById($id);
    }
}
