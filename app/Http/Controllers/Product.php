<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;

class Product extends Controller
{
    public function createProduct(ProductRequest $productRequest)
    {
        var_dump($productRequest->validated());
    }
}
