<?php

namespace App\ValueObjects\Contract;

interface ValueObject
{
    public function getValue();
    public static function create(...$params);
}
