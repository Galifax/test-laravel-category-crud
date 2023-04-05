<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class RedirectToValidLocale
{
    public function handle(Request $request, Closure $next): Response|Redirect
    {
        if (!in_array($request->segment(1), config('app.locales'))) {
            return Redirect::to(config('app.locale').'/'.$request->path());
        }

        app()->setLocale($request->segment(1));

        return $next($request);
    }
}
