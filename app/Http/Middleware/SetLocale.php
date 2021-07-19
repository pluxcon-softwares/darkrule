<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Session;
use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset($request['lang']))
        {
            Session::put('language', $request['lang']);
            $language = $request['lang'];
        }
        elseif(Session::has('language'))
        {
            $language = Session::get('language');
        }
        elseif(config('app.locale'))
        {
            $language = config('app.locale');
        }

        if(isset($language))
        {
            app()->setlocale($language);
        }
        return $next($request);
    }
}
