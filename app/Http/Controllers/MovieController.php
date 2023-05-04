<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSeat;
use App\Models\Seat;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MovieController extends Controller
{

    public function get_movie_list($id = null)
    {
        $client = new Client();
        $movies = Movie::select('id', 'imdb_id', 'ticket_fee')->get();

        $movie_list = array();
        foreach ($movies as $movie) {
            $response = $client->request('GET', 'http://www.omdbapi.com/?i=' . $movie->imdb_id . '&apikey=' . env('API_KEY'));
            $movie_data = json_decode($response->getBody());
            $movie_data->ticket_fee = $movie->ticket_fee;
            $movie_data->id = $movie->id;
            $movie_list[] = $movie_data;
        }
        return $movie_list;
    }

    public function get_movie_info($id)
    {
        $movie = Movie::where("id", $id)->first();
        $client = new Client();
        $response = $client->request('GET', 'http://www.omdbapi.com/?i=' . $movie->imdb_id . '&apikey=' . env('API_KEY'));
        return json_decode($response->getBody());
    }

    public function index()
    {
        $movie_list = $this->get_movie_list();
        return view("welcome", compact('movie_list'));
    }

    public function info(Request $request)
    {
        $movie = $this->get_movie_info($request->movie_id);
        // dd($movie);
        return view("info", compact('movie'));
    }

    public function seat()
    {
        $seat_list = Seat::all();
        return view("seat", [
            "seat_list" => $seat_list
        ]);
    }

    public function booking(Request $request)
    {
        $cus_name = $request->cus_name;
        $cus_email = $request->cus_email;
        $seat_code = explode(",", $request->seat_code);
        $movie_id = $request->movie_id;

        foreach ($seat_code as $seat) {
            $seat_id = Seat::where("seat_code", trim($seat))->first()->id;
            $record = MovieSeat::where([
                "movie_id" => $movie_id,
                "seat_id" => $seat_id,
            ])->first();
            if (!$record) {

                MovieSeat::create([
                    "movie_id" => $movie_id,
                    "seat_id" => $seat_id,
                    "cus_name" => $cus_name,
                    "cus_email" => $cus_email,
                ]);
            }
        }
        $user = User::where("email", $cus_email)->first();
        if (!$user) {
            User::create([
                "name" => $cus_name,
                "email" => $cus_email,
            ]);
        }
        return "Success";
    }
    public function checking_booking()
    {
        return view("login");
    }

    public function search_order(Request $request)
    {
        $records = MovieSeat::where("cus_email", $request->email)->get();
        if ($records->count() == 0) {
            return response()->json([
                "mess" => "Not found"
            ]);
        } else {
            $data = [];
            $group_record = $records->groupBy("movie_id");
            foreach ($group_record as $movieID => $movieRecords) {
                $movie_name = Movie::find($movieID)->name;
                $ticket_fee_total = Movie::find($movieID)->ticket_fee * $movieRecords->count();
                $seat_codes = Movie::find($movieID)->seats()->pluck("seat_code")->implode(",");
                $cus_name = $movieRecords->first()->cus_name;
                $cus_email = $movieRecords->first()->cus_email;
                $data[] = [
                    "movie_name" => $movie_name,
                    "seat_code" => $seat_codes,
                    "cus_name" => $cus_name,
                    "cus_email" => $cus_email,
                    "ticket_fee_total" => $ticket_fee_total,
                ];
            }
            return response()->json(compact("data"));
        }
    }

    public function checking_order(Request $request)
    {
        $seat_codes = Movie::find($request->movie_id)->seats()->pluck("seat_code")->implode(",");
        return response()->json([
            "seat_list" => $seat_codes
        ]);
    }

    public function cancel(Request $request)
    {
        $movie_id = Movie::where("name", $request->name)->first()->id;
        MovieSeat::where("movie_id", $movie_id)
            ->where("cus_email", $request->cus_email)
            ->delete();
        return response()->json([
            "status" => "success"
        ]);
    }

    public function login(Request $request)
    {
        $form_data = $request->validate([
            "email" => ["required", "email"]
        ]);

        $user = User::where("email", $form_data["email"])->first();

        if ($user) {
            auth()->login($user);
            $request->session()->regenerate();
            return response()->json([
                "status" => "success"
            ]);
        }
        return response()->json([
            "status" => "error"
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view("login");
    }

    public function confirm_order()
    {

        $records = MovieSeat::where("cus_email", auth()->user()->email)->get();
        $data = [];
        $group_record = $records->groupBy("movie_id");
        foreach ($group_record as $movieID => $movieRecords) {
            $movie_name = Movie::find($movieID)->name;
            $ticket_fee_total = Movie::find($movieID)->ticket_fee * $movieRecords->count();
            $seat_codes = Movie::find($movieID)->seats()->pluck("seat_code")->implode(",");
            $cus_name = $movieRecords->first()->cus_name;
            $cus_email = $movieRecords->first()->cus_email;
            $data[] = [
                "movie_name" => $movie_name,
                "seat_code" => $seat_codes,
                "cus_name" => $cus_name,
                "cus_email" => $cus_email,
                "ticket_fee_total" => $ticket_fee_total,
            ];
        }
        return view("confirm_order", [
            "data" => $data
        ]);
    }
}
