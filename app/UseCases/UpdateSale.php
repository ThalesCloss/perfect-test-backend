<?php

namespace App\UseCases;

use App\Entities\Sale;
use App\Repositories\EloquentRepositories\EloquentSaleRepository;
use App\Repositories\Exceptions\SaleNotFound;
use App\UseCases\Contracts\SaleRepository;
use DateTime;
use Exception;

class UpdateSale
{
    private SaleRepository $saleRepository;
    function __construct(
        EloquentSaleRepository $saleRepository
    ) {
        $this->saleRepository = $saleRepository;
    }

    function update(array $saleUpdate, int $id)
    {
        $saleData = $this->saleRepository->getById($id);
        if (empty($saleData))
            throw new SaleNotFound('A venda não foi localizada');
        $saleData['sold_at'] = new  DateTime($saleData['sold_at']);
        $sale = Sale::fromArray($saleData, $id);
        $sale->setAmount($saleUpdate['amount']);
        $sale->setDiscount($saleUpdate['discount']);
        $sale->setStatus($saleUpdate['status']);
        $sale->setSoldAt($saleUpdate['sold_at']);
        if (!$sale->validateDiscount())
            throw new Exception('O desconto aplicado não pode ser maior que o total da venda');
        $this->saleRepository->save($sale);
        return;
    }
}
