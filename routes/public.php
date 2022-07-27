<?php

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
  ################ THIS IS ONLY FOR DEVELOPMENT
*/
if (config("app.env", "production") == "local") {
    Route::get('artisan/{command}', function ($command) {
        try {
            $artisan = Artisan::call(str_replace("_", " ", $command));
            $output = Artisan::output();
            return str_replace("\n", "</br>", $output);
        } catch (Exception $e) {
            $artisan = Artisan::call("list");
            $output = Artisan::output();
            $error = str_replace("\n", "</br>", $e);
            return $error . "<br><br><br>" . str_replace("\n", "</br>", $output);
        }
    });
}
/*
################################
*/

Route::get('/', [\App\Http\Controllers\PublicController::class, "login"])->name("default.login");
Route::get('/login', [\App\Http\Controllers\PublicController::class, "login"])->name("login");
Route::post('/login', [\App\Http\Controllers\UserController::class, "login"])->name("user.login");
Route::get('/register', [\App\Http\Controllers\UserController::class, "register"])->name("register.view");
Route::post('/register', [\App\Http\Controllers\UserController::class, "handleRegister"])->name("register.handle");

Route::get('/password/reset', [\App\Http\Controllers\PublicController::class, "resetPassword"])->name("password.reset.view");
Route::post("/password/reset", [\App\Http\Controllers\PublicController::class, "resetPasswordLink"])->name("password.reset.send");

Route::get('/password/token/{token}', [\App\Http\Controllers\PublicController::class, "passwordToken"])->name("password.token.view");
Route::post("/password/token/{token}", [\App\Http\Controllers\PublicController::class, "resetPasswordToken"])->name("reset.password.Token");

//Ajax Calls:
Route::prefix("ajax")->group(function () {
    
});

//Borrar 
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::fallback(function () {

    return Inertia::render("Error");

});