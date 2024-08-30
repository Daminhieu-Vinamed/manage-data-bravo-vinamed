<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleManageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::user()->role->id === config('constants.number.one') || 
            Auth::user()->role->id === config('constants.number.two') || 
            Auth::user()->role->id === config('constants.number.three') || 
            Auth::user()->role->id === config('constants.number.four') ||
            Auth::user()->role->id === config('constants.number.five')
        ) {
            return $next($request);
        }
        return redirect()->back();
    }
}