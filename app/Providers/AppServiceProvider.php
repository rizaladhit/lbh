<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share app settings with all views
        View::composer('*', function ($view) {
            try {
                $appSetting = AppSetting::getSettings();
            } catch (\Exception $e) {
                $appSetting = new AppSetting(['app_name' => config('app.name'), 'logo_path' => null]);
            }
            $view->with('appSetting', $appSetting);
        });
    }
}
