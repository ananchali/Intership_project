<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->session()->get('locale', 'en');
        
        // Validate locale is supported
        $supportedLocales = ['en', 'am', 'om', 'so'];
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'en';
        }
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
