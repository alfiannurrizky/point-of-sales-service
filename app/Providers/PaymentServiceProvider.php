<?php

namespace App\Providers;

use App\Services\Payment\PaymentServiceImplement;
use App\Services\Payment\PaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceInterface::class, PaymentServiceImplement::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
