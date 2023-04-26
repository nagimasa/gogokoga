<?php

namespace App\Providers;

use App\Models\Owner;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;
use Laravel\Cashier\Cashier;

use Illuminate\Routing\UrlGenerator;
// use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    //check that app is local
    // if (!$this->app->isLocal()) {
    //     //else register your services you require for production
    //     $this->app['request']->server->set('HTTPS', true);
    // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

     public function boot()
     {
         Cashier::useCustomerModel(Owner::class);
         if (request()->isSecure()) {
            URL::forceScheme('https');
        }
        //  if (App::environment('production','staging')) {
        //     URL::forceScheme('https');
     }
     
    //  public function boot(UrlGenerator $url)
    // {
    //     Cashier::useCustomerModel(Owner::class);
    //     $url->forceScheme('https');
    // }
}
