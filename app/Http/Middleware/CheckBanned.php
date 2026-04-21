<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   

    public function handle(Request $request, Closure $next)
{
    if (auth()->check() && auth()->user()->banned_at) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Your account has been suspended.');
    }

    return $next($request);
}
}
