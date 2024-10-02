@extends('layout.header')

@section('content')
<div class="my-4 mx-4">
    <a href="/" class="btn btn-primary px-4">Back</a>
</div>
<div class="container info my-5 d-md-flex justify-content-between">

    <div class="card mx-sm-auto w-auto" style="width: 18rem;">
        <img src="{{ $movieInfo->Poster }}" class="card-img-top img-fluid" alt="...">

        <div class="card-body bg-dark text-white">
            <p class="card-text">{{ $movieInfo->Plot }}</p>
            <a href="/seat?movieInfo_id=${movieInfo_id}" class="btn btn-success d-block">Book</a>
        </div>
    </div>

    <div class="info_wrapper w-75 w-100 border border-1 rounded-1">
        <div class="inner p-lg-5 text-center" style="width: 100%; min-width: 100%;">
            <h1>{{ $movieInfo->Title }}</h1>
            <div class="movieInfo_info w-100 mx-auto">
                <ul class="list-group">
                    <li class="list-group-item">Year: {{ $movieInfo->Year }}</li>
                    <li class="list-group-item">Rated: {{ $movieInfo->Rated }}</li>
                    <li class="list-group-item">Released: {{ $movieInfo->Released }}</li>
                    <li class="list-group-item">Duration: {{ $movieInfo->Runtime }}</li>
                    <li class="list-group-item">Genre: {{ $movieInfo->Genre }}</li>
                </ul>
                <div class="starring d-flex mt-3">
                    <p>Starring: {{ $movieInfo->Actors }}</p>
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
                                @foreach ($movieInfo->Ratings as $rating)
                                <tr>
                                    <td>{{ $rating->Source }}</td>
                                    <td>{{ $rating->Value }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Metascore</td>
                                    <td>{{ $movieInfo->Metascore }}</td>
                                </tr>
                                <tr>
                                    <td>imdbRating</td>
                                    <td>{{ $movieInfo->imdbRating }}</td>
                                </tr>
                                <tr>
                                    <td>imdbVotes</td>
                                    <td>{{ $movieInfo->imdbVotes }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    {{-- comment --}}
    <div>
        
        @livewire('comment')
    </div>
@endsection