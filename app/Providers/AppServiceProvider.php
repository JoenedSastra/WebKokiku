<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $logoPath = Setting::get('logo_path');
            $logoImage = $logoPath && Storage::disk('public')->exists($logoPath)
                ? 'storage/' . $logoPath
                : 'images/logo_kokiku.png';
            $logoUrl = asset($logoImage);

            $view->with([
                'logoUrl' => $logoUrl,
                'logoImage' => $logoImage,
                'faviconUrl' => $logoUrl,
            ]);
        });
    }
}
