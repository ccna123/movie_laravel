<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{

    protected $movieService;
    protected $userService;

    public function __construct(MovieService $movieService, UserService $userService)
    {
        $this->movieService = $movieService;
        $this->userService = $userService;
    }

    public function index()
    {
        $movie_list = $this->movieService->get_movie_list();
        return view("welcome", compact('movie_list'));
    }

    public function info(Request $request)
    {
        $movieInfo = $this->movieService->get_movie_info($request->movie_id);
        $movieInfo->movieId = $request->movie_id;
        return view("info", compact('movieInfo'));
    }

    public function seat()
    {
        $seat_list = $this->movieService->get_seat_list();
        return view("seat", [
            "seat_list" => $seat_list
        ]);
    }

    public function booking(Request $request)
    {
        $this->movieService->set_booking($request);
    }
    public function checking_booking()
    {
        return view("login");
    }

    public function searchOrder(Request $request)
    {
        $data = $this->movieService->get_order($request);
        return response()->json(compact("data"));
    }

    public function checkingOrder(Request $request)
    {

        return response()->json([
            "seat_list" => $this->movieService->get_checkingOrder($request)
        ]);
    }

    public function cancel(Request $request)
    {
        return $this->movieService->cancel_order($request);
    }

    public function confirmOrder(Request $request)
    {
        return view("confirm_order", [
            "data" => $this->movieService->get_confirmOrder($request->query("email"))
        ]);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }
}
