<?php

namespace App\Repositories\EloquentRepositories;

use App\Entities\Sale;
use App\Repositories\Exceptions\SaleNotFound;
use App\Models\Sale as SaleModel;
use App\UseCases\Contracts\SaleRepository;
use DateTime;
use Illuminate\Support\Facades\DB;

class EloquentSaleRepository implements SaleRepository
{
    function save(Sale $sale): void
    {
        if (empty($sale->getId())) {
            $this->insert($sale);
            return;
        }

        $saleModel = $this->getModelById($sale->getId());
        if (empty($saleModel))
            throw new SaleNotFound("Não foi possível localizar o produto {$sale->getId()}");

        $this->update($saleModel, $sale);
        return;
    }

    private function insert(Sale $sale)
    {
        SaleModel::create($sale->toArray());
        return;
    }

    private function update(SaleModel $saleModel, Sale $sale)
    {
        $saleModel->fill($sale->toArray());
        $saleModel->save();
        return;
    }

    private function getModelById(int $id)
    {
        return SaleModel::with('customer')->find($id);
    }

    function delete(int $id): void
    {
        $saleDelete = $this->getModelById($id);
        if (!empty($saleDelete))
            $saleDelete->delete();
        return;
    }
    function getById(int $id): array
    {
        $sale = $this->getModelById($id);
        return $sale ? $sale->toArray() : [];
    }
    function getAll(): array
    {
        $sales = SaleModel::with('product')->get();
        return !empty($sales) ? $sales->toArray() : [];
    }

    function getSaleReport(): array
    {
        return DB::table('sales')->select(
            DB::raw('sum(amount) as amount, sum(total_price) as total, status')
        )->groupBy('status')->get()->toArray();
    }

    function getByCustomerPeriod(DateTime $initialDate, DateTime $endDate, int $id = null): array
    {

        $query = SaleModel::with('product')->whereBetween('sold_at', [$initialDate->setTime(0,0,0), $endDate->setTime(23,59,59)]);
        if (!empty($id)) {
            $query->where('customer_id', $id);
        }

        return $query->get()->toArray();
    }
}
