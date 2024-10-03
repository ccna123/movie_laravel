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
Route::get('/getMovies', [MovieController::class, "getMovies"]);
Route::get('/info', [MovieController::class, "info"]);
Route::get('/seat', [MovieController::class, "seat"]);
Route::post('/booking', [MovieController::class, "booking"]);
Route::post('/login', [MovieController::class, "login"]);
Route::get('/searchOrder', [MovieController::class, "searchOrder"]);
Route::get('/checkingBooking', [MovieController::class, "checking_booking"])->name('checkingBooking');
Route::get('/checkingOrder', [MovieController::class, "checkingOrder"]);
Route::post('/cancel', [MovieController::class, "cancel"]);
Route::get('/confirmOrder', [MovieController::class, "confirmOrder"])->name('confirmOrder');
Route::post('/logout', [MovieController::class, "logout"]);

/* test event */
Route::get("/admin", [AdminController::class, "index"])->middleware("auth");
Route::post("/updateMovie", [AdminController::class, "updateMovie"]);
Route::post("/deleteMovie", [AdminController::class, "deleteMovie"]);
Route::post("/addMovie", [AdminController::class, "addMovie"]);
Route::post("/updateInfo", [AdminController::class, "updateInfo"]);
Route::post("/updateImg", [AdminController::class, "updateImg"]);
Route::delete("/deleteImg", [AdminController::class, "deleteImg"]);
Route::post("/updateAdminName", [AdminController::class, "updateAdminName"]);
Route::post("/updateAdminEmail", [AdminController::class, "updateAdminEmail"]);
Route::post("/import_movie_data", [AdminController::class, "import_movie_data"]);
Route::post("/import_seat_data", [AdminController::class, "import_seat_data"]);
