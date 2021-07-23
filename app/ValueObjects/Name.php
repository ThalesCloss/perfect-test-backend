<?php

namespace App\ValueObjects;

use App\ValueObjects\Contract\ValueObject;
use App\ValueObjects\Exceptions\ValueObjectException;

class Name implements ValueObject
{
    private string $name;
    private function __construct($name)
    {
        $this->name = $name;
    }

    public static function create(...$params)
    {
        $name = trim($params[0]);
        if (empty($name) || sizeof(explode(' ', $name, 2)) < 2)
            throw new ValueObjectException('O valor para o nome não é válido');
        return new self($name);
    }

    public function getValue()
    {
        return $this->name;
    }
}
