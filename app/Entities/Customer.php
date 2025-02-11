<?php

namespace App\Entities;

use App\Entities\Exceptions\CreateCustomerException;
use App\ValueObjects\CPF;
use App\ValueObjects\Email;
use App\ValueObjects\Name;

class Customer
{
    private Name $name;
    private CPF $cpf;
    private Email $email;
    private ?int $id;

    private function __construct(string $name, string $cpf, string $email, int $id = null)
    {
        $this->name = Name::create($name);
        $this->cpf = CPF::create($cpf);
        $this->email = Email::create($email);
        $this->id = $id;
    }

    static function fromArray(array $customer, int $id = null)
    {
        if (!key_exists('name', $customer) || !key_exists('cpf', $customer) || !key_exists('email', $customer))
            throw new CreateCustomerException("Informe todos os campos do cliente");
        return new self($customer['name'], $customer['cpf'], $customer['email'], $id);
    }
    public function toArray()
    {
        return array_filter(
            [
                "id" => $this->id,
                "name" => $this->getName(),
                "email" => $this->getEmail(),
                "cpf" => $this->getCPF()
            ]
        );
    }

    public function getName()
    {
        return $this->name->getValue();
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email->getValue();
    }
    public function getCPF()
    {
        return $this->cpf->getValue();
    }
}
