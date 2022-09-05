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
Auth::routes();

Route::get("/login", "App\Http\Controllers\LoginController@get")->name("login_page");
Route::post("/login", "App\Http\Controllers\LoginController@login")->name("login");
Route::post("/logout", "App\Http\Controllers\LoginController@logout")->name("logout");

Route::name("cart.")->prefix("/cart")->group(function(){
    Route::post("/", "App\Http\Controllers\ProductsController@addToCart")->name("add_to_cart");
    Route::get("/", "App\Http\Controllers\ProductsController@get")->name("cart_page");
});

Route::name("product.")->prefix("/product")->group(function(){
    Route::post("/create", "App\Http\Controllers\ProductsController@create")->name("create");
    Route::post("/add", "App\Http\Controllers\ProductsController@add")->name("add");
});

Route::redirect('/home', '/')->name('home');
