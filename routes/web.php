<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminController;
use App\Jobs\SendEmailJob;
use App\Mail\TestMail;
use App\Providers\TaskEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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
Route::get('/checking_booking', [MovieController::class, "checking_booking"])->name('checking_booking');
Route::get('/checking_order', [MovieController::class, "checking_order"]);
Route::post('/cancel', [MovieController::class, "cancel"]);
Route::get('/confirm_order', [MovieController::class, "confirm_order"])->name('confirm_order');
Route::post('/logout', [MovieController::class, "logout"]);

/* test event */
Route::get('event', function () {
    event(new TaskEvent('how are you'));
});
Route::get('listen', function () {
    return view('broadcast');
});

Route::get("/admin", [AdminController::class, "index"])->middleware("auth");
Route::post("/update_movie", [AdminController::class, "update_movie"]);
Route::post("/delete_movie", [AdminController::class, "delete_movie"]);
Route::post("/add_movie", [AdminController::class, "add_movie"]);
Route::post("/update_info", [AdminController::class, "update_info"]);
Route::post("/update_img", [AdminController::class, "update_img"]);
Route::delete("/delete_img", [AdminController::class, "delete_img"]);
Route::post("/update_admin_name", [AdminController::class, "update_admin_name"]);
Route::post("/update_admin_email", [AdminController::class, "update_admin_email"]);
