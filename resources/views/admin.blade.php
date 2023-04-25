@extends('layout.header')

@section('content')

@if (session()->has("update_message"))    
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get("update_message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@elseif (session()->has("delete_message"))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session()->get("delete_message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="container mt-5">
        <div class="wrapper">
            <h1>Dashboard</h1>
            @include('modal.add_movie')
            <button type="submit" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addMovie">Add movie <span><i class="fa-solid fa-plus"></i></span></button>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="movie-tab" data-bs-toggle="tab" data-bs-target="#movie-tab-pane" type="button" role="tab" aria-controls="movie-tab-pane" aria-selected="true">Movie</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="movie-tab-pane" role="tabpanel" aria-labelledby="movie-tab" tabindex="0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imdb</th>
                        <th scope="col">Name</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $index = 1?>
                      @foreach ($movie_list as $movie)     
                      @include('modal.edit_modal')
                      @include('modal.delete_modal')
                      <tr>
                        <th scope="row">{{ $index }}</th>
                        <td>{{ $movie->imdb_id }}</td>
                        <td>{{ $movie->name}}</td>
                        <td>{{ $movie->ticket_fee }}$</td>
                        <td class="px-3">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $movie->id }}"><i class="fa-solid fa-pen"></i></a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $movie->id }}"><i class="fa-solid fa-trash" style="color: red"></i></a>
                        </td>
                      </tr>
                      <?php $index++?>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
              </div>
        </div>
    </div>

@endsection
