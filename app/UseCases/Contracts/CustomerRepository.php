<?php

namespace App\UseCases\Contracts;

use App\Entities\Customer;
use App\ValueObjects\CPF;
use App\ValueObjects\Email;

interface CustomerRepository
{

    public function save(Customer $customer): void;
    public function getById(int $id): array;
    public function getAll(): array;
    public function delete(int $id): void;
    public function getByEmailAndCpf(Email $email, CPF $cpf): array;
}
