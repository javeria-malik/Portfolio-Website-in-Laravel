<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Listen to database queries
        //DB::listen(function ($query) {
           // Log::info('SQL Query:', ['query' => $query->sql]);
           // Log::info('Bindings:', ['bindings' => $query->bindings]);
           // Log::info('Time:', ['time' => $query->time]); // Wrap $query->time in an array
        //});
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
