<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\UseCases\CreateProduct;
use App\UseCases\DeleteProduct;
use App\UseCases\GetProduct;
use App\UseCases\UpdateProduct;
use Illuminate\Http\Request;

class Product extends Controller
{
    private CreateProduct $createProductUseCase;
    private UpdateProduct $updateProductUseCase;
    private DeleteProduct $deleteProductUseCase;
    private GetProduct $getProductUseCase;
    public function __construct(
        CreateProduct $createProduct,
        UpdateProduct $updateProduct,
        DeleteProduct $deleteProduct,
        GetProduct $getProduct
    ) {
        $this->createProductUseCase = $createProduct;
        $this->updateProductUseCase = $updateProduct;
        $this->deleteProductUseCase = $deleteProduct;
        $this->getProductUseCase = $getProduct;
    }

    public function createProduct(ProductRequest $productRequest)
    {
        $this->createProductUseCase->create($productRequest->validated());
        return response()->redirectTo('/');
    }

    public function updateProduct(UpdateProductRequest $updateProductRequest)
    {
        $this->updateProductUseCase->update($updateProductRequest->validated(), $updateProductRequest->id);
        return response()->redirectTo('/');
    }

    public function getProduct(Request $request, $id)
    {
        $product = $this->getProductUseCase->get($id);
        if (empty($product))
            return redirect('/')->withErrors(['not_found' => 'Produto não localizado']);
        return response()->view('crud_products', $product);
    }


    public function deleteProduct(Request $request, $id)
    {
        $this->deleteProductUseCase->delete($id);
        return response()->redirectTo('/');
    }
}
