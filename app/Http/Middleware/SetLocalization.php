<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class SetLocalization
{
    public function translations($file)
    {
        $array = include $file;
        return $array;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            preg_match_all('/([a-z]{1,8})-[a-zA-Z]{1,8}/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

            // return the encoded language es = Spanish, en = English etc
            if (isset($lang_parse) && count($lang_parse) >= 2 && isset($lang_parse[1])) {
                $lng = $lang_parse[1][0];
            }

            App::setLocale($lng);
            Inertia::share(["translation" => $this->translations(resource_path("lang/{$lng}.php"))]);
            return $next($request);
        } catch (\Exception $e) {
            App::setLocale(config('app.locale'));
            Inertia::share(["translation" => $this->translations(resource_path("lang/" . config('app.locale') . ".php"))]);
            return $next($request);
        }
    }
}
