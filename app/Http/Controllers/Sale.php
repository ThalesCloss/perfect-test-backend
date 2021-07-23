<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\UseCases\CreateSale;
use App\UseCases\GetProducts;
use App\UseCases\GetSale;
use App\UseCases\UpdateSale;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class Sale extends Controller
{
    private CreateSale $createSaleUseCase;
    private GetProducts $getProductsUseCase;
    private GetSale $getSaleUseCase;
    private UpdateSale $updateSaleUseCase;
    function __construct(CreateSale $createSale, GetProducts $getProducts, GetSale $getsale, UpdateSale $updateSale)
    {
        $this->createSaleUseCase = $createSale;
        $this->getProductsUseCase = $getProducts;
        $this->getSaleUseCase = $getsale;
        $this->updateSaleUseCase = $updateSale;
    }
    public function createSale(SaleRequest $saleRequest)
    {
        try {
            $sale = $saleRequest->validated();
            $sale['sold_at'] = DateTime::createFromFormat('d/m/Y', $sale['sold_at']);
            $this->createSaleUseCase->create($sale);
            return redirect('/');
        } catch (\Error $e) {
            return redirect()->back()->withErrors(['sale' => $e->getMessage()])->withInput($saleRequest->validated());
        }
    }

    public function sale()
    {
        $products = $this->getProductsUseCase->get();
        return view('crud_sales')->with('products', $products);
    }

    public function getSale(Request $request, $id)
    {
        $sale = $this->getSaleUseCase->get($id);

        if (empty($sale))
            return redirect('/')->withErrors(['not_found' => 'Venda não localizada']);
        $products = $this->getProductsUseCase->get();
        $sale['sold_at'] = (new DateTime($sale['sold_at']))->format('d/m/Y');
        return response()->view('crud_sales', array_merge($sale, ['products' => $products]));
    }

    public function updateSale(UpdateSaleRequest $updateSale, $id)
    {
        try {
            $sale = $updateSale->validated();
            $sale['sold_at'] = DateTime::createFromFormat('d/m/Y', $sale['sold_at']);
            $this->updateSaleUseCase->update($sale, $id);
            return redirect('/');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['sale' => $e->getMessage()])->withInput($updateSale->validated());
        }
    }
}
