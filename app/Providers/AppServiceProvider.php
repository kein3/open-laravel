<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Patch spécial Codespaces : forcer le root URL
        if (env('APP_URL')) {
            URL::forceRootUrl(env('APP_URL'));
        }

        // Si tu veux forcer https (fortement conseillé sur Codespaces) :
        if (str_starts_with(env('APP_URL'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
