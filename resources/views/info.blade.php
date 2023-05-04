@extends('layout.header')

@section('content')
<div class="my-4 mx-4">
    <a href="/" class="btn btn-primary px-4">Back</a>
</div>
<div class="container info my-5 d-md-flex justify-content-between">
    <div class="card mx-sm-auto w-auto" style="width: 18rem;">
        <img src="{{ $movie->Poster }}" class="card-img-top img-fluid" alt="...">
        <div class="card-body bg-dark text-white">
            <p class="card-text">{{ $movie->Plot }}</p>
            <a href="/seat?movie_id=${movie_id}" class="btn btn-success d-block">Book</a>
        </div>
    </div>

<div class="info_wrapper w-75 w-100">
    <div class="inner p-lg-5 text-center" style="width: 100%; min-width: 100%;">
        <h1>{{ $movie->Title }}</h1>
        <div class="movie_info w-50 mx-auto">
        <ul class="list-group">
        <li class="list-group-item">Year: {{ $movie->Year }}</li>
        <li class="list-group-item">Rated: {{ $movie->Rated }}</li>
        <li class="list-group-item">Released: {{ $movie->Released }}</li>
        <li class="list-group-item">Duration: {{ $movie->Runtime }}</li>
        <li class="list-group-item">Genre: {{ $movie->Genre }}</li>
      </ul>
        <div class="starring d-flex">
            <p>Starring: {{ $movie->Actors }}</p>
        </div>
        <div class="rating">
            <h1>Ratings</h1>
            <div class="rating_info">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Source</th>
                          <th>Score</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movie->Ratings as $rating)
                            <tr>
                                <td>{{ $rating->Source }}</td>
                                <td>{{ $rating->Value }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Metascore</td>
                            <td>{{ $movie->Metascore }}</td>
                        </tr>
                        <tr>
                            <td>imdbRating</td>
                            <td>{{ $movie->imdbRating }}</td>
                        </tr>
                        <tr>
                            <td>imdbVotes</td>
                            <td>{{ $movie->imdbVotes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection