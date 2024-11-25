<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsCustomer
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
         if (Auth::user() &&  Auth::user()->role_id == 6) {
                return $next($request);
         } else {
            return redirect()->route('dashboard');
         }
    }
}
