<?php

namespace App\ValueObjects;

use App\ValueObjects\Contract\ValueObject;
use App\ValueObjects\Exceptions\ValueObjectException;
use Illuminate\Support\Facades\Validator;

class CPF implements ValueObject
{
    private string $cpf;
    private function __construct($cpf)
    {
        $this->cpf = $cpf;
    }

    public static function create(...$params)
    {
        $cpf = str_replace('-', '', str_replace('.', '', trim($params[0])));

        $validator = Validator::make(['cpf' => $cpf], ['cpf' => 'required|cpf']);
        if ($validator->fails())
            throw new ValueObjectException('O CPF informado é inválido');
        return new self($cpf);
    }

    public function getValue()
    {
        return $this->cpf;
    }
}
