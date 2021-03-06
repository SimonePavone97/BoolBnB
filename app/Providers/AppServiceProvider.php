<?php

namespace App\Providers;

use Braintree\Gateway;
use App\Providers\Braintree_Configuration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'n8pdc2q57r93h69f',
            'publicKey' => 'ty62v5tg8q2gmr2d',
            'privateKey' => '4e44b2109487cc96f7e8e6a5e05e24b2'
        ]);
    }
}
