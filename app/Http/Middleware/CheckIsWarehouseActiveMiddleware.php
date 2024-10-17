<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsWarehouseActiveMiddleware
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
            Auth::user()->is_warehouse_active == config('constants.number.one')
        ) {
            return $next($request);
        }
        return redirect()->back();
    }
}