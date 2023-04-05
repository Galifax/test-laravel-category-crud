<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $locales = [];

        foreach(config('app.locales') as $lang) {
            $locales[] = [
                'lang' => $lang,
                'url' => '/'.$lang.stristr(request()->path(), '/')
            ];
        }

        View::share('locales', $locales);
    }
}
