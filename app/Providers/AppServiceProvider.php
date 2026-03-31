<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\HtmlString;
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
        // Force HTTPS hanya di production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        URL::forceRootUrl(config('app.url'));
    
        Carbon::setLocale('id');

        Validator::resolver(function (
        $translator,
        $data,
        $rules,
        $messages,
        $attributes
        ) {
            $translator->setLocale('id');
            return new \Illuminate\Validation\Validator(
                $translator,
                $data,
                $rules,
                $messages,
                $attributes
            );
        });

        FilamentView::registerRenderHook(
            'panels::head.end',
            fn () => new HtmlString(
                '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>'
            )
        );
    }
    
}
