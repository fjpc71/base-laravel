<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        foreach (explode("|", $role) as $user_type) {
            if ($user_type == Auth::user()->type->slug) {
                return $next($request);
            }
        }
        throw new \App\Exceptions\MessageException(__('auth.no_permissions'));
    }
}
