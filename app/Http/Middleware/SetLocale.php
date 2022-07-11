<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (request('change_language')) {
            if(in_array(request('change_language'), (config('translatable.locales')))){
                session()->put('language', request('change_language'));
                $language = request('change_language');
            }
        } elseif ($request->header('change-language')) {
            $language = $request->header('change-language');
        } elseif (session('language')) {
            $language = session('language');
        }

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}


