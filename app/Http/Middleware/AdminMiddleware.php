<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 1) {
                return $next($request); // Allow Admin to proceed
            } else {
                return redirect()->route('dashboard.users')->with('error', 'Access denied.');
            }
        }

        return redirect()->route('login')->with('error', 'Please log in first.');
    }
}
