<?php

namespace App\Http\Controllers;

use App\UseCases\GetProducts;
use App\UseCases\GetSale;

class Dashboard extends Controller
{
    private GetProducts $getProducts;
    function __construct(GetSale $getSale, GetProducts $getProducts)
    {
        $this->getProducts = $getProducts;
    }

    function dashBoard()
    {
        $products = $this->getProducts->get();
        return view('dashboard', ["products" => $products]);
    }
}
