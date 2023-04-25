<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $movie_list = Movie::all();
        return view("admin", [
            "movie_list" => $movie_list
        ]);
    }

    public function update_movie(Request $request)
    {
        $movie = Movie::find($request->movie_id)->first();
        
        $movie->imdb_id = $request->imdb;
        $movie->name = $request->movie_name;
        $movie->ticket_fee = $request->ticket_fee;

        $movie->save();
        return redirect("admin")->with("update_message", "Update successfully");
    }
    
    public function delete_movie(Request $request)
    {
        Movie::find($request->movie_id)->delete();
        return redirect("admin")->with("delete_message", "Delete successfully");
    }

    public function add_movie(Request $request)
    {
        
    }
}
