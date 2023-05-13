<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSeat;
use App\Models\Profit;
use App\Models\Proft;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $movie_list = Movie::all();
        $group_record = MovieSeat::groupBy("movie_id")
            ->select("movie_id", DB::raw("count(*) as total"))
            ->get();
        $profit_data = [];
        foreach ($group_record as $value) {
            $profit = Movie::find($value->movie_id)->ticket_fee * $value->total;
            $record = Profit::where("movie_id", $value->movie_id)->first();
            if (!$record) {
                Profit::create([
                    "movie_id" => $value->movie_id,
                    "profit" => $profit,
                ])->save();
            }
        }

        $profit_data = DB::table("profits")
            ->join("movies", "profits.movie_id", "=", "movies.id")
            ->select("movies.name", "profits.profit")
            ->get();
        // dd(User::where('email', auth()->user()->email)->first()->img);
        return view("admin/admin", [
            "movie_list" => $movie_list,
            "profit_data" => $profit_data,
            "total_profit" => Profit::sum('profit'),
            "admin_img" => User::where('email', auth()->user()->email)->first()->img
        ]);
    }

    public function update_movie(Request $request)
    {

        $movie = Movie::where("id", $request->movie_id)->first();
        // dd($movie->name);

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
        $movie = Movie::where("imdb_id", $request->imdb)->get();
        if ($movie->count() == 0) {
            Movie::create([
                "imdb_id" => $request->imdb,
                "name" => $request->movie_name,
                "ticket_fee" => $request->ticket_fee,
            ])->save();
            return redirect("admin")->with("add_message", "Add movie successfully");
        }
        return redirect("admin")->with("exist_message", "This movie is already exist");
    }

    public function update_info(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'profie_img' => ['required', 'mimes:png,jpg,jpeg', 'max:150000']
        ]);

        $ImgNewName = time() . '.' . $request->profie_img->extension();
        $request->profie_img->move(public_path('images'), $ImgNewName);


        $user = User::where("email", auth()->user()->email)->first();
        $user->img = $ImgNewName;
        $user->save();
        return redirect('/admin')->with('update_info', 'Information is successfully updated');
    }
}
