<?php

namespace App\Providers;

use App\Models\Footer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $footer = Footer::select(['id', 'made_at', 'made_by'])->first()->toArray();
        View::Share('footer', $footer);
    }
}
