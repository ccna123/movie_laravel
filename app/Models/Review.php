<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'movie_id',
        'content'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function movies()
    {
        return $this->belongsTo(Movie::class, "movie_id", "id");
    }
}
