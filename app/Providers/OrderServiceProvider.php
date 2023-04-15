<?php

namespace App\Providers;

use App\Services\Order\OrderServiceImplement;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderServiceInterface::class, OrderServiceImplement::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
