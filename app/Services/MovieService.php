<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\MovieSeat;
use App\Models\Seat;
use App\Models\User;
use GuzzleHttp\Client;

class MovieService
{
    public function get_movie_list()
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

    public function get_seat_list()
    {
        return Seat::all();
    }

    public function set_booking($request)
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

    public function get_order($request)
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
        }

        return $data;
    }

    public function get_checking_order($request)
    {
        $seat_codes = Movie::find($request->movie_id)->seats()->pluck("seat_code")->implode(",");
        return $seat_codes;
    }

    public function cancel_order($request)
    {
        $movie_id = Movie::where("name", $request->name)->first()->id;
        MovieSeat::where("movie_id", $movie_id)
            ->where("cus_email", $request->cus_email)
            ->delete();
        return response()->json([
            "status" => "success"
        ]);
    }

    public function get_confirm_order()
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
        return $data;
    }
}
