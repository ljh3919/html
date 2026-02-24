<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Transport\PhpMailTransport;

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
        Mail::extend('php_mail', function (array $config) {
            return new PhpMailTransport();
        });
    }
}
