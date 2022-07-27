<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UseConstant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$values)
    {
        foreach ($values as $value) {
            $elements = explode("=", $value);
            if (count($elements) == 2) {
                $request[$elements[0]] = $elements[1];
            }
        }

        return $next($request);
    }
}
