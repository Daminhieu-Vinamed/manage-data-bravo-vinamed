<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBirthdayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = new Carbon();
        $birthdayUser = Carbon::parse(Auth::user()->birthday);
        if ($birthdayUser->format('m-d') == $now->format('m-d')) {
            return $next($request);
        }
        return redirect()->route('welcome');
    }
}