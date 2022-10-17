<?php

namespace App\Providers;

use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IStoreService;
use App\Services\Interfaces\IUserService;
use App\Services\ProductService;
use App\Services\StoreService;
use App\Services\UserService;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
use App\Services\AuthenticationService;
use App\Services\AuthorizationService;
use App\Services\Interfaces\IAuthorizationService;
use App\Services\Interfaces\IAuthService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IProductRepo;
use App\Repositories\Interfaces\IStoreRepo;
use App\Repositories\Interfaces\IUserRepo;
use App\Repositories\DbTransactionRepository;
use App\Repositories\Interfaces\IDbTransaction;
use App\Repositories\Interfaces\IStoreProductRepo;
use App\Repositories\StoreProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepo::class, UserRepository::class);
        $this->app->bind(IAuthService::class, AuthenticationService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAuthorizationService::class, AuthorizationService::class);
        $this->app->bind(IStoreRepo::class, StoreRepository::class);
        $this->app->bind(IStoreService::class, StoreService::class);
        $this->app->bind(IProductRepo::class, ProductRepository::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IDbTransaction::class, DbTransactionRepository::class);
        $this->app->bind(IStoreProductRepo::class, StoreProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
