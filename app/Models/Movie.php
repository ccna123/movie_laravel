<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        "imdb_id",
        "name",
        "ticket_fee",
    ];

    public function seats()
    {
        return $this->belongsToMany(Seat::class, "movie_seats");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
