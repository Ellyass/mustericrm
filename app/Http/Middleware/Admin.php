<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check() && (\Auth::user()->role=='admin' || \Auth::user()->role=='user' || \Auth::user()->role=='repair')) {
            return $next($request);
        } else {
            return redirect(route('default.login.Login'))->with('error','Erişim yetkiniz yok');
        }
    }
}

