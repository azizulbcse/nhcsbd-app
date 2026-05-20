<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // এই লাইনটি যোগ হলো

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
        // লারাভেলকে ডিফল্ট টেইলউইন্ডের বদলে প্রফেশনাল বুটস্ট্র্যাপ পেজিনেশন ব্যবহার করতে বলা হলো
        Paginator::useBootstrapFive(); 
    }
}
