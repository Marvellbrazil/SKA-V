<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Marquee;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
        $assetBase = config('app.url');

        $view->with('assetBase', $assetBase);
    });

        SymfonyRequest::setTrustedProxies(
            ['*'],
            SymfonyRequest::HEADER_X_FORWARDED_FOR |
                                SymfonyRequest::HEADER_X_FORWARDED_HOST |
                                SymfonyRequest::HEADER_X_FORWARDED_PROTO |
                                SymfonyRequest::HEADER_X_FORWARDED_PORT
        );

        // ✅ Force HTTPS in production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // ✅ Share marquee data to all views
        View::composer('*', function ($view) {
            try {
                $marquees = Marquee::query()
                    ->orderBy('urutan')
                    ->orderBy('nama')
                    ->get();
                $view->with('marquees', $marquees);
            } catch (\Exception) {
                $view->with('marquees', collect());
            }
        });
    }
}
