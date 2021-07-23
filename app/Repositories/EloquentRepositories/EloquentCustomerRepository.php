<?php

namespace App\Repositories\EloquentRepositories;

use App\Entities\Customer;
use App\Models\Customer as CustomerModel;
use App\Repositories\Exceptions\CustomerNotFound;
use App\UseCases\Contracts\CustomerRepository;
use App\ValueObjects\Email;
use App\ValueObjects\CPF;

class EloquentCustomerRepository implements CustomerRepository
{
    function save(Customer $customer): void
    {
        if (empty($customer->getId())) {
            $this->insert($customer);
            return;
        }

        $customerModel = $this->getModelById($customer->getId());
        if (empty($customerModel))
            throw new CustomerNotFound("Não foi possível localizar o produto {$customer->getId()}");

        $this->update($customerModel, $customer);
        return;
    }

    private function insert(Customer $customer)
    {
        $insertedCustomer = CustomerModel::create($customer->toArray());
        $customer->setId($insertedCustomer->id);
        return;
    }

    private function update(CustomerModel $customerModel, Customer $customer)
    {
        $customerModel->fill($customer->toArray());
        $customerModel->save();
        return;
    }

    private function getModelById(int $id)
    {
        return CustomerModel::find($id);
    }

    function delete(int $id): void
    {
        $customerDelete = $this->getModelById($id);
        if (!empty($customerDelete))
            $customerDelete->delete();
        return;
    }
    function getById(int $id): array
    {
        $customer = $this->getModelById($id);
        return $customer ? $customer->toArray() : [];
    }
    function getAll(): array
    {
        $customers = CustomerModel::all();
        return !empty($customers) ? $customers->toArray() : [];
    }

    function getByEmailAndCpf(Email $email, CPF $cpf): array
    {
        $find = CustomerModel::where([['email', $email->getValue()], ['cpf', $cpf->getValue()]])->first();
        return !empty($find) ? $find->toArray() : [];
    }
}
