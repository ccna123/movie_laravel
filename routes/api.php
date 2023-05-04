<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource("movies", MovieApiController::class);
Route::get("/movies", [MovieApiController::class, "index"]);
Route::get("/get_api_key", [MovieApiController::class, "get_api_key"]);


Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("/movies", [MovieApiController::class, "store"]);
    Route::get("/movies/search/{name}", [MovieApiController::class, "search"]);
    Route::delete("/movies/{id}", [MovieApiController::class, "destroy"]);
    Route::get("/movies/{id}", [MovieApiController::class, "show"]);
    Route::put("/movies/{id}", [MovieApiController::class, "update"]);
    Route::post("/logout", [AuthController::class, "logout"]);
});
