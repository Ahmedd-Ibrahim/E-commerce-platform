<?php
namespace App\Providers;

use App\Cart\Cart;
use App\Cart\Payments\Getway;
use App\Cart\Payments\Getways\StripGetway;
use Stripe\Stripe;
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
        $this->app->singleton(Cart::class, function ($app) {
            return new Cart($app->auth->user());
        });

        $this->app->singleton(Getway::class, function ($app) {
            return new StripGetway;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}
