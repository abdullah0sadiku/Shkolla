<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check if the user is authenticated and has the specified role
        if (!Auth::check() || !Auth::user()->hasRole('Drejtor')) {
            return redirect('404'); // Redirect or show an error
        }

        return $next($request);
    }
}
