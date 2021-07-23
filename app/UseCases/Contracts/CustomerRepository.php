<?php

namespace App\UseCases\Contracts;

use App\Entities\Customer;

interface CustomerRepository
{

    public function save(Customer $customer): void;
    public function getById(int $id): array;
    public function getAll(): array;
    public function delete(int $id): void;
    public function getByEmailAndCpf($email, $cpf): array;
}
