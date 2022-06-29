<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAgencyExists
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('agencies.index');
        }
        if (auth()->user()->agencies()->exists()) {
            session(['agency_id' => auth()->user()->agencies()->first()->id]);
            return $next($request);
        }
        return redirect()->route('agencies.create');
    }
}
