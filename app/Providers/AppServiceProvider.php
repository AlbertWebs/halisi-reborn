<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('client', fn ($value) => \App\Models\Billing\Client::findOrFail($value));
        Route::bind('invoice', fn ($value) => \App\Models\Billing\Invoice::findOrFail($value));
        Route::bind('category', fn ($value) => \App\Models\JourneyCategory::where('slug', $value)->orWhere('id', $value)->firstOrFail());
    }
}
