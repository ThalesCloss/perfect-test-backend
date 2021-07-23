<?php

namespace App\Repositories\MemoryRepositories;

use App\Entities\Customer;
use App\Repositories\Exceptions\CustomerNotFound;
use App\UseCases\Contracts\CustomerRepository;
use App\ValueObjects\CPF;
use App\ValueObjects\Email;

class MemoryCustomerRepository implements CustomerRepository
{
    public $customers = [];
    public function save(Customer $customer): void
    {
        if (!$customer->getId()) {
            $id = sizeOf($this->customers) + 1;
            $this->customers[$id] = $customer->toArray();
            $customer->setId($id);
            return;
        };
        $this->customers[$customer->getId()] = $customer->toArray();
    }

    public function getAll(): array
    {
        return $this->customers;
    }

    public function getById(int $id): array
    {
        if (empty($this->customers[$id]))
            throw new CustomerNotFound("Nenhum produto foi encontrado para o localizador $id");
        return $this->customers[$id];
    }

    public function delete(int $id): void
    {
        if (empty($this->customers[$id]))
            throw new CustomerNotFound("Nenhum produto foi encontrado para o localizador $id");
        $this->customers[$id] = null;
        return;
    }
    public function getByEmailAndCpf(Email $email, CPF $cpf): array
    {
        $search = array_filter($this->customers, function ($val) use ($email, $cpf) {
            if ($val['email'] === $email->getValue() && $val['cpf'] === $cpf->getValue())
                return true;
            return false;
        });
        return $search;
    }
}
