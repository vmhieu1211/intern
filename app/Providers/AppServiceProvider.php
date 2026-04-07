<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\SystemSetting;
use App\Policies\OrderPolicy;
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
        Gate::policy(Order::class, OrderPolicy::class);

        try {
            $setting = SystemSetting::first();
            View::share('shareSettings', $setting);
            View::share('systemName', $setting);
        } catch (\Exception $e) {
            // DB chưa sẵn sàng (artisan commands, migrations)
        }
    }
}
