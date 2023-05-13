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

@elseif (session()->has("exist_message"))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session()->get("exist_message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@elseif (session()->has("add_message"))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get("add_message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  @elseif (session()->has("update_info"))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get("update_info") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="container mt-5">
        <div class="wrapper">
            <h1>Dashboard</h1>
            {{-- profile info --}}
          <form action="update_info" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                  @if (file_exists(public_path('images/'.$admin_img)))
                    
                    <img 
                    src="images/{{ $admin_img }}" 
                    id="profile_img" 
                    class="img-fluid img-thumbnail rounded mx-auto d-block w-auto" 
                    style="height: 15rem"
                    >
                
                  @else

                    <img src="{{ asset('images/noprofil.jpg') }}" id="profile_img" class="img-fluid img-thumbnail rounded mx-auto d-block w-auto" style="height: 15rem">
                    <p>
                      {{ $admin_img }}
                    </p>
                  @endif

                  <div class="d-flex align-items-center justify-content-center mt-3">
                    <button class="btn btn-unstyled" id="cancel_btn">
                      <i class="fa-solid fa-circle-xmark fa-2xl" style="color: #ff0505;"></i>
                    </button>
                  </div>
                  
                  <div class="my-3">
                    <input class="form-control" type="file" id="formFile" name="profie_img">
                    @error('profie_img')
                        <p class="fw-bold text-danger">
                          {{ $message }}
                        </p>
                    @enderror
                  </div>
                </div>
                
                <div class="col-md-8">
                <div class="row g-3">
                  
                  <div class="col-md-12">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="fw-bold text-danger">
                          {{ $message }}
                        </p>
                    @enderror
                  </div>
              
                  <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="fw-bold text-danger">
                          {{ $message }}
                        </p>
                    @enderror
                  </div>
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-info w-100" id="update_btn">Update Info</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
            {{-- end profile info --}}
            <hr>
            @include('modal.add_movie')
            <button type="submit" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addMovie">Add movie <span><i class="fa-solid fa-plus"></i></span></button>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="movie-tab" data-bs-toggle="tab" data-bs-target="#movie-tab-pane" type="button" role="tab" aria-controls="movie-tab-pane" aria-selected="true">Movie</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profit-tab" data-bs-toggle="tab" data-bs-target="#profit-tab-pane" type="button" role="tab" aria-controls="profit-tab-pane" aria-selected="false">Profit</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                {{-- movie --}}
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

                {{-- profit --}}
                <div class="tab-pane fade" id="profit-tab-pane" role="tabpanel" aria-labelledby="profit-tab" tabindex="0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Profit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $index = 1?>
                      @foreach ($profit_data as $profit)     
                      <tr>
                        <th scope="row">{{ $index }}</th>
                        <td>{{ $profit->name}}</td>
                        <td>${{ $profit->profit }}</td>
                      </tr>
                      <?php $index++?>
                      @endforeach
                      
                      <tr class="fw-bold h2">
                        <td colspan="2">
                          Total
                        </td>
                        <td>
                          ${{ $total_profit }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="js/previewImage.js"></script>
@endsection