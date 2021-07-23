<?php

namespace App\ValueObjects;

use App\ValueObjects\Contract\ValueObject;
use App\ValueObjects\Exceptions\ValueObjectException;
use Illuminate\Support\Facades\Validator;

class Email implements ValueObject
{
    private string $email;
    private function __construct($email)
    {
        $this->email = $email;
    }

    public static function create(...$params)
    {
        $email = trim($params[0]);

        $validator = Validator::make(['email' => $email], ['email' => 'required|email']);
        if ($validator->fails())
            throw new ValueObjectException('O e-mail informado é inválido');
        return new self($email);
    }

    public function getValue()
    {
        return $this->email;
    }
}
