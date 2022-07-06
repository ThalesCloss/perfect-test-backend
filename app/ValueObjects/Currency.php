<?php

namespace App\ValueObjects;

use App\ValueObjects\Contract\ValueObject;
use App\ValueObjects\Exceptions\ValueObjectException;

class Currency implements ValueObject
{
    private float $value;
    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function create(...$params)
    {
        $value = (float) $params[0];
        if ($value < 0 || !is_numeric($params[0]))
            throw new ValueObjectException("Erro ao criar o valor monetário $params[0]");
        return new self($value);
    }

    public function getValue()
    {
        return $this->value;
    }
}
