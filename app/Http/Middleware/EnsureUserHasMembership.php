<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->subscriptions()->active()->count() == 0) {
            return redirect()->route('checkout', [env('STRIPE_MEMBERSHIP_PRICE_ONE')]);
        }

        if ($request->user()->type === "vendor") {
            return $next($request);
        }

        return redirect('/');
    }
}
