<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\SearchController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
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

    Route::get("/register", [RegisterController::class, "index"])->name('register');
    Route::post("/register", [RegisterController::class, "store"]);
    
    Route::get("/login", [LoginController::class, "index"])->name('login');
    Route::post("/login", [LoginController::class, "store"]);

    Route::get('/logout', [LogoutController::class, "store"])->name("logout");

    Route::get("/", [HomeController::class, "index"])->name('home');

    Route::get("/search", [SearchController::class, "deny"]);
    Route::post("/search", [SearchController::class, "query"])->name('search');

    Route::get("/pin/{locID}", [ProfileController::class, "pin"])->name('pin');
    
    Route::get('/welcome', function () {
        return view('welcome');
    });
