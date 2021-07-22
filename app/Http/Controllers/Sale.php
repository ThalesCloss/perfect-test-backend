<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;

class Sale extends Controller
{
    public function createSale(SaleRequest $saleRequest)
    {
        var_dump($saleRequest->validated());
    }
}
