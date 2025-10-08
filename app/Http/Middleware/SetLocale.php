<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $lang = $request->cookie('lang', 'en');
        App::setLocale($lang);
        return $next($request);
    }
}
