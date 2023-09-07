<?php

namespace App\Providers;


use App\Http\Retail\IdentityType\Dao\IdentityTypeDaoImpl;
use App\Http\Retail\IdentityType\Dao\IdentityTypeDao;
use Illuminate\Support\ServiceProvider;

class RetailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(CustomerDao::class, CustomerDaoImpl::class);
        $this->app->singleton(IdentityTypeDao::class, IdentityTypeDaoImpl::class);
//        $this->app->singleton(ItemDao::class, ItemDaoImpl::class);
//        $this->app->singleton(RegionDao::class, RegionDaoImpl::class);
//        $this->app->singleton(SupplierDao::class, SupplierDaoImpl::class);

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
}
