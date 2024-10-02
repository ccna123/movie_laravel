@extends('layout.header')

@section('content')


{{-- movie list --}}
<div id="movie" class="container">
    <div class="row">
        @foreach ($movie_list as $movie)
        <div class="col-lg-4 col-md-6 col-12 p-4 text-center">
            <div class="card mx-auto" style="width: 20rem;">
                <div>
                    <img src="{{$movie->Poster}}" class="card-img-top img-fluid" style="width: 500px; height: 500px;">
                </div>
                <hr>
                <div class="card-body">
                    <div>
                        <h5 class="card-title">{{$movie->Title}}</h5>
                    </div>
                    <div>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($movie->Plot, 100, '...') }} <a style="display: inline" href="/info?movie_id={{ $movie->id }}">View</a></p>
                    </div>
                    <div>
                        <p class="card-text mt-4 fw-bold h1">Ticket: ${{ $movie->ticket_fee }}</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="/info?movie_id={{ $movie->id }}" class="btn btn-primary d-block">Info</a>
                        <a href="/seat?movie_id={{ $movie->id }}" class="btn btn-success d-block mt-4">Book</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $movie_list->links() }}
    </div>
</div> 
@endsection