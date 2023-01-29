<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
     public function register()
     {
         $this->reportable(function (InertiaMessage $e) {
             //
         });
    }

    public function render($request, Throwable $e)
    {
        if (is_a($e, \App\Exceptions\MessageException::class)) {
            session()->flash('danger', $e->message);
            return Redirect::back();
        } elseif (is_a($e, ValidationException::class)) {
            $msg = "";
            foreach ($e->errors() as $error) {
                $msg .= $error[0];
            }
            return response(["message" => $msg], $e->status);
        } elseif (is_a($e, \Illuminate\Auth\AuthenticationException::class)) {
            $response = parent::render($request, $e);

            if (Auth::user()) {
                session()->flash('danger', __('auth.failed'));
            }
            return Redirect::to("/login");
        } elseif (is_a($e, \Illuminate\Session\TokenMismatchException::class)) {
            session()->put("previous_url", url()->current());
            return Redirect::to("/login");
        }
        $response = parent::render($request, $e);
        
        session()->flash("danger", $e->getMessage());
        return Redirect::back();
        return response(
            [
                "exception-line" => $e->getLine(),
                "exception-file" => $e->getFile(),
                "message" => $e->getMessage()
            ],
            $response->status()
        );
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        session(['previous_url' => $request->path()]);
        if ($request->expectsJson()) {
            return response(['message' => __('auth.failed')], 401);
        }

        return Redirect::guest('/login');
    }
}
