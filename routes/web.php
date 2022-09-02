<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect("/", "/login");

Route::view("/login", "login")->name("login_page");
Route::post("/login", "App\Http\Controllers\LoginController@login")->name("login");

Route::get("/cart", "App\Http\Controllers\ProductsController@get")->name("cart_page");
// Route::post("/cart", "ProductsController@")->name("cart");