<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [MovieController::class, "index"]);
Route::get('/get_movies', [MovieController::class, "get_movies"]);
Route::get('/info', [MovieController::class, "info"]);
Route::get('/seat', [MovieController::class, "seat"]);
Route::post('/booking', [MovieController::class, "booking"]);
Route::post('/login', [MovieController::class, "login"]);
Route::get('/search_order', [MovieController::class, "search_order"]);
Route::get('/checking_booking', [MovieController::class, "checking_booking"]);
Route::get('/checking_order', [MovieController::class, "checking_order"]);
Route::post('/cancel', [MovieController::class, "cancel"]);
Route::get('/confirm_order', [MovieController::class, "confirm_order"]);
Route::post('/logout', [MovieController::class, "logout"]);

Route::get("/admin", [AdminController::class, "index"])->middleware("auth");
Route::post("/update_movie", [AdminController::class, "update_movie"]);
Route::post("/delete_movie", [AdminController::class, "delete_movie"]);
Route::post("/add_movie", [AdminController::class, "add_movie"]);
