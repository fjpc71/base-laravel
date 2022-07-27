<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPaswordToken;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\MessageException;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function login()
    {
        if (Auth::check()) {

            switch (Auth::user()->user_types_id) {
                case '1': //Admin
                    return Redirect::route('private.users');
                    break;
                    
                default:
                    return Inertia::render("Login");
                    break;
            }

        }

        return Inertia::render("Login");
    }

    public function resetPassword()
    {
        if (Auth::check()) {
            return Redirect::route("dashboard");
        }
        return Inertia::render("ResetPassword");
    }

    public function resetPasswordLink(Request $request)
    {
        if (Auth::check()) {
            return redirect('/index');
        }

        $request->validate([
            "email" => "required"
        ]);

        $user = User::where("email", $request["email"]);
        if ($user->exists()) {
            $user = $user->first();
            $passwordReset = PasswordResets::createToken($user->email);
            Mail::to($user->email)->send(new SendPaswordToken($passwordReset->token, $user->name));
            return Redirect::route("login.view");
        }
        throw new MessageException("this user does not exist");
    }

    public function passwordToken(String $token)
    {
        $reset = PasswordResets::where("token", $token);

        if ($reset->exists()) {
            return Inertia::render("PasswordToken", ["token" => $token]);
        }
        return Redirect::route("login.view");
    }

    public function resetPasswordToken(String $token, Request $request)
    {
        $request->validate([
            "password" => "required",
            "passwordRepeat" => "required"
        ]);

        if ($request->password !== $request->passwordRepeat) {
            throw new MessageException("the passwords have to be the same");
        }

        if ($request["password"] && strlen($request["password"]) >= 6) {
            $reset = PasswordResets::where("token", $token)->firstOrFail();
            $user = User::where("email", $reset->email);
            if ($user->exists()) {
                $user = $user->first();
                $user->password = Hash::make($request["password"]);
                $user->save();
                PasswordResets::where([
                    ["token", "=", $token],
                    ["email", "=", $reset->email]
                ])->delete();
                return Redirect::route("login.view");
            }
        }
    }
}
