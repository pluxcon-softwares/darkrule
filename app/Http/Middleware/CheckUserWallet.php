<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserWallet
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
        if(Auth::user()->wallet < 200)
        {
            $balance  = Auth::user()->wallet;
            return redirect()
            ->route('home')
            ->with('lowfunds', "Your wallet is low $$balance, fund your wallet with minimum of $200 before you can explore our store!");
        }
        return $next($request);
    }
}
