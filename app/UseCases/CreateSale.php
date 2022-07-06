<?php

namespace App\UseCases;

use App\Entities\Customer;
use App\Entities\Sale;
use App\Repositories\EloquentRepositories\EloquentCustomerRepository;
use App\Repositories\EloquentRepositories\EloquentProductRepository;
use App\Repositories\EloquentRepositories\EloquentSaleRepository;
use App\UseCases\Contracts\CustomerRepository;
use App\UseCases\Contracts\ProductRepository;
use App\UseCases\Contracts\SaleRepository;
use App\ValueObjects\CPF;
use App\ValueObjects\Email;

class CreateSale
{
    private SaleRepository $saleRepository;
    private CustomerRepository $customerRepository;
    private ProductRepository $productRepository;
    function __construct(
        SaleRepository $saleRepository,
        CustomerRepository $customerRepository,
        ProductRepository $productRepository
    ) {
        $this->saleRepository = $saleRepository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }

    function create(array $sale)
    {
        $email = Email::create($sale['email']);
        $cpf = CPF::create($sale['cpf']);
        $customer = $this->checkIfCustomerExists($email, $cpf);
        if (empty($customer)) {
            $customer = Customer::fromArray(['name' => $sale['name'], 'email' => $sale['email'], 'cpf' => $sale['cpf']]);
            $this->customerRepository->save($customer);
        }
        $product = $this->productRepository->getById($sale['product_id']);
        if (empty($product))
            throw new \Error('O produto selecionado não está disponível para venda');

        $saleEntity = Sale::fromArray([
            'customer_id' => $customer->getId(),
            'product_id' => $product['id'],
            'unit_price' => $product['price'],
            'amount' => $sale['amount'],
            'discount' => $sale['discount'],
            'sold_at' => $sale['sold_at'],
            'status' => $sale['status']
        ]);

        $this->saleRepository->save($saleEntity);
    }

    function checkIfCustomerExists(Email $email, CPF $cpf)
    {
        $customer = $this->customerRepository->getByEmailAndCpf($email, $cpf);
        if (!empty($customer))
            return Customer::fromArray($customer, $customer['id']);
        return null;
    }
}
