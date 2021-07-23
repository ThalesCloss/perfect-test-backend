<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/sales', function () {
    return view('crud_sales');
});
Route::get('/products', function () {
    return view('crud_products');
});

Route::post('/products', 'Product@createProduct');
Route::get('/products/{id}', 'Product@getProduct');
Route::put('/products/{id}', 'Product@updateProduct');
Route::post('/sales', 'Sale@createSale');
