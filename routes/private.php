<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/profile', [UserController::class, 'getProfile'])->name('user.get');
Route::put('/profile', [UserController::class, 'editProfile'])->name('user.edit');

Route::get('/logout', [App\Http\Controllers\UserController::class, "logout"])->name("logout");

Route::middleware("is:admin")->group(function () {//Admin routes.
    
    Route::prefix("private")->group(function () {
        //Usuarios:
        Route::get("/users/lists", [\App\Http\Controllers\UserController::class, "listUsers"])->name('private.users');
        Route::post("/user/new", [\App\Http\Controllers\UserController::class, "storeUser"]);
        Route::get("/user/get/{id}", [\App\Http\Controllers\UserController::class, "getUser"]);
        Route::post("/user/update/{id}", [\App\Http\Controllers\UserController::class, "updateUser"]);
        Route::post("/user/delete/{id}", [\App\Http\Controllers\UserController::class, "deleteUser"]);
        Route::post("/users/search", [\App\Http\Controllers\UserController::class, "searchUsers"]);
       
    });

    //Ajax Calls:
    Route::prefix("ajax")->group(function () {
        
    });

});