<?php

namespace App\Entities;

use App\Entities\Exceptions\CreateProductException;
use App\ValueObjects\Currency;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private Currency $price;

    private function __construct(string $name, string $description, float $price, int $id = null)
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->id = $id;
    }

    static function fromArray(array $product, int $id = null)
    {
        if (!key_exists('name', $product) || !key_exists('description', $product) || !key_exists('price', $product))
            throw new CreateProductException("Informe todos os campos do produto");
        return new self($product['name'], $product['description'], $product['price'], $id);
    }

    public function toArray()
    {
        return array_filter(
            [
                "id" => $this->id,
                "name" => $this->name,
                "description" => $this->description,
                "price" => $this->price->getValue()
            ]
        );
    }

    public function setName(string $name)
    {
        if (empty($name))
            throw new CreateProductException('O nome do produto deve ser informado');
        $this->name = trim($name);
    }

    public function setPrice(float $price)
    {

        $this->price = Currency::create($price);
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }


    public function getPrice()
    {
        return $this->price->getValue();
    }

    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }
}
