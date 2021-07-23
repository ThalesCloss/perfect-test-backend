<?php

namespace App\Providers;

use App\Repositories\EloquentRepositories\EloquentCustomerRepository;
use App\Repositories\EloquentRepositories\EloquentProductRepository;
use App\Repositories\EloquentRepositories\EloquentSaleRepository;
use App\UseCases\Contracts\CustomerRepository;
use App\UseCases\Contracts\ProductRepository;
use App\UseCases\Contracts\SaleRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(CustomerRepository::class, EloquentCustomerRepository::class);
        $this->app->bind(SaleRepository::class, EloquentSaleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [
            ProductRepository::class,
            CustomerRepository::class,
            SaleRepository::class
        ];
    }
}
