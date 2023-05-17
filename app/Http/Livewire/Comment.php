<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{

    public $comments;
    public $newComment;
    public $movie_id;

    protected $rules = [
        'newComment' => 'required'
    ];

    public function mount(Request $request)
    {
        $this->comments = Review::where("movie_id", $request->movie_id)->get();
        $this->movie_id = $request->movie_id;
    }


    public function add()
    {
        $this->validate();

        $newRecord = Review::create([
            "user_id" => auth()->user()->id,
            "movie_id" => $this->movie_id,
            "content" => $this->newComment
        ]);
        $this->comments->prepend($newRecord);
        $this->newComment = '';
        session()->flash("message", "Add review successfully");
    }

    public function delete($comment_id)
    {
        Review::find($comment_id)->delete();
        $this->comments = $this->comments->except($comment_id);
        session()->flash("message", "Delete review successfully");
    }


    public function render()
    {
        return view('livewire.comment');
    }
}
