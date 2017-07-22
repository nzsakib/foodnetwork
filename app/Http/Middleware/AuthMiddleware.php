<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use URL;

class AuthMiddleware
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
        if(Auth::check())
            return $next($request);
        else {
            $redirect = parse_url(url()->current())['path'];
            return redirect('auth/login' . '?r=' . $redirect);
        }
    }
}
