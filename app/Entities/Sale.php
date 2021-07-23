<?php

namespace App\Entities;

use App\Entities\Exceptions\CreateSaleException;
use App\ValueObjects\Currency;
use DateTime;

class Sale
{
    private int $customer_id;
    private int $product_id;
    private DateTime $sold_at;
    private Currency $discount;
    private string $status;
    private Currency $unit_price;
    private int $amount;
    private ?int $id;
    private const KEYS = ['customer_id', 'product_id', 'sold_at', 'discount', 'status', 'unit_price', 'amount'];
    private const STATUS_ENUM = ['approved', 'canceled', 'returned'];
    private function __construct(int $customer_id, int $product_id, DateTime $sold_at, float $discount, string $status, float $unit_price, int $amount, int $id = null)
    {
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->sold_at = $sold_at;
        $this->discount = Currency::create($discount);
        $this->setStatus($status);
        $this->unit_price = Currency::create($unit_price);
        $this->setAmount($amount);
        $this->id = $id;
    }

    static function fromArray(array $sale, int $id = null)
    {
        $filtredInput = array_filter($sale, function ($val) {
            return in_array($val, self::KEYS);
        }, ARRAY_FILTER_USE_KEY);
        if (sizeof($filtredInput) != sizeof(self::KEYS))
            throw new CreateSaleException("Informe todos os campos da venda");
        return new self($sale['customer_id'], $sale['product_id'], $sale['sold_at'], $sale['discount'], $sale['status'], $sale['unit_price'], $sale['amount'], $id);
    }
    public function toArray()
    {
        return array_filter(
            [
                "id" => $this->id,
                "customer_id" => $this->getCustomerId(),
                "product_id" => $this->getProductId(),
                "sold_at" => $this->getSoldAt(),
                "discount" => $this->getDiscount(),
                "amount" => $this->getAmount(),
                "unit_price" => $this->getUnitPrice(),
                "total_price" => $this->getTotalPrice(),
                "status" => $this->getStatus()
            ]
        );
    }

    public function setStatus(string $status)
    {
        if (!in_array($status, self::STATUS_ENUM))
            throw new CreateSaleException("O status informado é inválido");
        $this->status = $status;
    }

    public function setAmount(int $amount)
    {
        if ($amount <= 0)
            throw new CreateSaleException('A quantidade informada é inválida');
        $this->amount = $amount;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getSoldAt()
    {
        return $this->sold_at;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getAmount()
    {
        return $this->amount;
    }
    public function getUnitPrice()
    {
        return $this->unit_price->getValue();
    }
    public function getDiscount()
    {
        return $this->discount->getValue();
    }
    public function getTotalPrice()
    {
        return ($this->amount * $this->getUnitPrice()) - $this->getDiscount();
    }
    public function getStatus()
    {
        return $this->status;
    }
}
