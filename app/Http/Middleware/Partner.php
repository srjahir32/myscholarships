<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Partner
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
        if (Auth::check() && Auth::user()->role == 'partner') {
            return $next($request);
        }
        // elseif (Auth::check() && Auth::user()->role == 'user') {
        //     return redirect('/user');
        // }
        else {
            return redirect('login');
        }
    }
}
