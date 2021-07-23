<?php

namespace App\UseCases;

use App\UseCases\Contracts\SaleRepository;
use DateTime;

class GetSalesPeriodCustomer
{
    private SaleRepository $saleRepository;
    function __construct(
        SaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function get(DateTime $initialData, DateTime $finalData, int $id = null)
    {
        return $this->saleRepository->getByCustomerPeriod($initialData, $finalData, $id);
    }
}
