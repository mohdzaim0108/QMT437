<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect('/login');
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has the required role
        if ($user->role != $role) {
            // Redirect to home page or show unauthorized message
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        // Allow the request to proceed
        return $next($request);
    }
}
