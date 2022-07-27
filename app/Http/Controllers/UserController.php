<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\UserTypes;
use App\Models\Lang;
use App\Models\Country;

use App\Traits\LangTrait;

use App\Exceptions\MessageException;

use Inertia\Inertia;

class UserController extends Controller
{
    use LangTrait;

    public function register()
    {
        $langs = Lang::get();
        $countries = Country::get();
        $user_types = UserTypes::where('name', '!=', 'admin')->get();

        return Inertia::render("Register", ["langs" => $langs, "countries" => $countries, "user_types" => $user_types]);
    }

    public function handleRegister(Request $request)
    {
        $validated = $request->validate([
          "name" => "required",
          "password" => ["required"], //"password"],
          "email" => ["required", "unique:users,email"],
          // "request_validation" => "required"
        ]);

        $validated["password"] = Hash::make($validated["password"]);

        $validated["nif"] = $request->nif;
        $validated["telephone"] = $request->phone;
        $validated["lang_id"] = $request->lang;
        $validated["country_id"] = $request->country;
        $validated["user_types_id"] = $request->userType;
        $validated["username"] = $request->name;

        $user = User::create($validated);
       // Auth::login($user);
       if($user):

        //Envia notificación por email al administrador.
        $user_admin = User::where("name", 'admin')->first();

        $subject = __('New user.');
        $plain = __("New user request with username: ") . $user->username . __(" and email: ") . $user->email;
        $to = $user_admin->email;

        Mail::raw($plain, function($message) use($plain, $to, $subject){
            $message->from('admin@test.tld', 'myproject');
            $message->to($to);
            $message->subject($subject);
        });

        return Inertia::render("Login", ["msg" => __("valid.new_user_solicited")]);
       endif;
    }

    public function login(Request $request)
    {
        $request->validate([
          "email" => ["required"],
          "password" => "required"
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request["remember"] ? true: false;
        $user = User::where("email", $request->email)
                    ->where("access", 1)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has("remember") ? $request->remember : false);

            //Guarda el ID del país e idioma en variables de sesión.
            Session::put('country_id', $user->country_id);
            Session::put('lang_id', $user->lang_id);

            return Redirect::route('private.users');
            
        }

        throw new MessageException(__("auth.failed"), 422);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

    public function getProfile()
    {
        $data = Auth::user()->only("email", "name", "username", "phone");

        return Inertia::render("Profile", ["pickedUser" => $data]);
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
          "email" =>[ "nullable", "email"],
          "password" => "password",
          "name" => "string",
          "active" => "boolean",
          "username" => ["required", "exists:users,username"]
        ]);

        if (array_key_exists("password", $validated) && $validated["password"] != "") {
            $validated['password'] = Hash::make($validated["password"]);
        }

        $user->update($validated);

        return response(["message" =>__("valid.profile_updated")]);
    }

    public function listUsers()
    {
        $users = User::with('country', 'lang' )->paginate(10);
        $userTypes = UserTypes::get();
        $langs = Lang::get();
        $countries = Country::get();

        return Inertia::render("Users/UsersList", ["users" => $users, "langs" => $langs, "countries" => $countries, "userTypes" => $userTypes, "url" => "user/get"]);

    }

    public function searchUsers(Request $request)
    {

            $users = User::with('country', 'lang' )
                            ->where('name', 'like', '%' . $request->name . '%')
                            ->orWhere('telephone', 'like', '%' . $request->name . '%')
                            ->paginate(10);
            $userTypes = UserTypes::get();
            $langs = Lang::get();
            $countries = Country::get();
    
            return Inertia::render("Users/UsersList", ["users" => $users, "langs" => $langs, "countries" => $countries, "userTypes" => $userTypes, "url" => "user/get"]);
        
    }

    public function storeUser(Request $request)
    {

            $validated = $request->validate([
                "name" => "required",
                "password" => ["required"],
                "email" => ["required", "email", "unique:users,email"],
                "username" => ["required", "unique:users,username"],
                "access" => ["required"],
                "user_types_id" => ["required"],
                "lang_id" => ["required"],
                "country_id" => ["required"],
            ]);

            $validated['telephone'] = $request->telephone;
            $validated['nif'] = $request->nif;
            $validated['access'] = $request->access - 1;
  
          $validated["password"] = Hash::make($validated["password"]);
  
          User::create($validated);

          return response(["message" => __("valid.user_created")]);

    }

    public function getUser($id)
    {
        $users = User::with('country', 'lang' )->paginate(10);

        $user = User::where('id', $id)->first();
        $userTypes = UserTypes::get();
        $langs = Lang::get();
        $countries = Country::get();


        return Inertia::render("Users/UsersList", ["users" => $users, "user" => $user, "langs" => $langs, "countries" => $countries, "userTypes" => $userTypes, "modal" => true]);
    }

    public function updateUser(Request $request, $id)
    {

        $validated = $request->validate([
            "name" => "required",
            "email" => ["required", "email", "unique:users,email," . $id],
            "username" => ["required", "unique:users,username," . $id],
            "access" => ["required"],
            "user_types_id" => ["required"],
            "lang_id" => ["required"],
            "country_id" => ["required"],
        ]);

        $validated['telephone'] = $request->telephone;
        $validated['nif'] = $request->nif;
        $validated['access'] = $request->access - 1;

        if($request->password) { $validated["password"] = Hash::make($request->password); }

        User::where('id', $id)->update($validated);

        return response(["message" => __("valid.user_updated")]);
    }

    public function deleteUser(Request $request, $id)
    {

        User::where('id', $id)->delete();

        return Redirect::route("private.users");

    }

    public function getHome()
    {

        return Inertia::render("Homes/Home", ["isoCode" => $this->getLangIsoCode()]);
    }

}
