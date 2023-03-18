<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $languages = ['ar', 'en','fr'];

    public function handle($request, Closure $next)
    {
        if(!session()->has('locale'))
        {
            session()->put('locale', 'ar'); //$request->getPreferredLanguage($this->languages));
        }
        // App::setLocale(session('locale'));
        app()->setLocale(session('locale'));
    
        return $next($request);
    }
}
