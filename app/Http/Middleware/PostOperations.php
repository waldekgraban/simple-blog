<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class PostOperations {

    public function handle($request, Closure $next)
    {
        if(Auth::check() && (in_array(Auth::user()->role->name, Role::LOGIN_ALLOWS_ROLE)))
        {
            return $next($request);
        }

        return redirect('/');
    }
}