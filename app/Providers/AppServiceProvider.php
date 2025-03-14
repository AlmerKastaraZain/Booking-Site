<?php

namespace App\Providers;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;

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
        Paginator::useTailwind();
        Cashier::calculateTaxes();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Allow migration to read folders
        $migrationPath = database_path('migrations');
        $directories = glob($migrationPath . "/*", GLOB_ONLYDIR);
        $paths = array_merge([$migrationPath], $directories);
        $this->loadMigrationsFrom($paths);

    }
}
