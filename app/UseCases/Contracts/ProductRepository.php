<?php

namespace App\UseCases\Contracts;

use App\Entities\Product;

interface ProductRepository
{

    public function save(Product $product): void;
    public function getById(int $id): array;
    public function getAll(): array;
    public function delete(int $id): void;
}
