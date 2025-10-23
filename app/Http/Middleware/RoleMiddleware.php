<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Support for multiple roles: "admin,lecturer"
        $roleNames = array_map('trim', explode(',', $role));
        if (Auth::check() && in_array(strtolower(Auth::user()->role->name), array_map('strtolower', $roleNames))) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}