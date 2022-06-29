<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $last_15_days = User::where([['id', auth()->id()], ['created_at', '<', now()->subdays(15)]])->exists();
        if (auth()->check() && (auth()->user()->is_active === 0) && $last_15_days) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('trial-expiry');
        }
        return $next($request);
    }
}
