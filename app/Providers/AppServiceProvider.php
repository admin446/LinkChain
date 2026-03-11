<?php
declare(strict_types=1);
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
        // 偵測是否在 HTTPS 環境下，若是則強制生成 https 連結
        if ($this->app->environment('production') || isset($_SERVER['HTTPS'])) {
            URL::forceScheme('https');
        }
    }
}
