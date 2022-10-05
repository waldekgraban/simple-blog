<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class UserOperations {

    public function handle($request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->role->name == Role::ADMIN_ROLE))
        {
            return $next($request);
        }

        return redirect('/');
    }
}