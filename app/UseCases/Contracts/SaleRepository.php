<?php

namespace App\UseCases\Contracts;

use App\Entities\Sale;
use DateTime;

interface SaleRepository
{

    public function save(Sale $sale): void;
    public function getById(int $id): array;
    public function getAll(): array;
    public function delete(int $id): void;
    public function getSaleReport(): array;
    public function getByCustomerPeriod(DateTime $initialDate, DateTime $endDate, int $id): array;
}
