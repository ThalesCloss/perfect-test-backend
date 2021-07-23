<?php

namespace App\Http\Controllers;

use App\UseCases\GetProducts;
use App\UseCases\GetSale;
use App\UseCases\GetSalesReport;

class Dashboard extends Controller
{
    private GetProducts $getProducts;
    private GetSalesReport $getSalesReport;
    function __construct(GetSalesReport $getSalesReport, GetProducts $getProducts)
    {
        $this->getProducts = $getProducts;
        $this->getSalesReport = $getSalesReport;
    }

    function dashBoard()
    {
        $products = $this->getProducts->get();
        $salesReport = $this->getSalesReport->get();
        return view('dashboard', ["products" => $products, "salesReport" => $salesReport]);
    }
}
