<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentRepositories\EloquentCustomerRepository;
use App\UseCases\Contracts\CustomerRepository;
use App\UseCases\GetProducts;
use App\UseCases\GetSales;
use App\UseCases\GetSalesPeriodCustomer;
use App\UseCases\GetSalesReport;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    private GetProducts $getProducts;
    private GetSalesReport $getSalesReport;
    private GetSales $getSales;
    private GetSalesPeriodCustomer $getSalesPeriod;
    private CustomerRepository $customerRepository;
    function __construct(GetSalesReport $getSalesReport, GetProducts $getProducts, GetSales $getSales, GetSalesPeriodCustomer $getSalesPeriod, CustomerRepository $customerRepository)
    {
        $this->getProducts = $getProducts;
        $this->getSalesReport = $getSalesReport;
        $this->getSales = $getSales;
        $this->getSalesPeriod = $getSalesPeriod;
        $this->customerRepository = $customerRepository;
    }

    function dashBoard(Request $request)
    {
        $products = $this->getProducts->get();
        $salesReport = $this->getSalesReport->get();
        $custumers = $this->customerRepository->getAll();
        if (!empty($request->query('interval'))) {
            $date = explode('-', $request->query('interval'));
            if (empty($date[0]) || empty($date[1]))
                return redirect('/');
            $initialDate = DateTime::createFromFormat('d/m/Y', trim($date[0]));
            $finalDate = DateTime::createFromFormat('d/m/Y', trim($date[1]));
            $customerId = $request->query('customer_id') ?? null;
            $sales = $this->getSalesPeriod->get($initialDate, $finalDate, $customerId);
        } else {
            $sales = $this->getSales->get();
        }
        return view('dashboard', ["products" => $products, "salesReport" => $salesReport, 'sales' => $sales, 'customers'=>$custumers]);
    }
}
