<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the logged-in user is blocked
        if (auth()->check() && auth()->user()->is_blocked) {
            // Redirect them back with an error message if they are blocked
            return redirect('/')->withErrors('Your account has been blocked from accessing our services.');
        }

        return $next($request);
    }
}
