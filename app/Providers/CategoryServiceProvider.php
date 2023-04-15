<?php

namespace App\Providers;

use App\Services\Category\CategoryServiceInterface;
use App\Services\Category\CategoryServiceImplement;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryServiceImplement::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
