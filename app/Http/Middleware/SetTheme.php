<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTheme
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (request('theme')) {
            session(['theme' => request('theme')]);
        } elseif (session('theme')) {
            session(['theme' => session('theme')]);
        } else {
            session(['theme' => 'light-layout']);
        }
        return $next($request);
    }
}
