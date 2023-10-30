<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->ajax() || $request->wantsJson()) {
            if (Session::has('user*%') && Auth::guard('customauth')->user()) {
                return $next($request);
            }
            Auth::logout();
            Session::flush();
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
