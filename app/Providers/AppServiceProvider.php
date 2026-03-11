<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 確保只在 local 開發環境才載入 IDE Helper，避免污染正式機
        if ($this->app->environment('local')) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
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
