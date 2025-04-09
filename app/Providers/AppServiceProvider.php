<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        $shareSettings = SystemSetting::first(); 
        View::share('shareSettings', $shareSettings);
        $systemName = SystemSetting::first(); 
        View::share('systemName', $systemName);
    }
}
