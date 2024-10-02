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
@elseif (session()->has("upload_img"))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session()->get("upload_img") }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
{{-- mess --}}
<div id="mess">
</div>
{{-- end mess --}}
<div class="container mt-5">
  <div class="wrapper">
    <h1>Dashboard</h1>
    {{-- profile info --}}
    <form action="update_info" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-4">

          <div class="my-3">

            <img src="{{ auth()->user()->img ? asset('images/'.auth()->user()->img) : asset('images/noprofile.jpg') }} "
              class="img-fluid" id="profile_img" style="width: 20rem; height: 100%;">

            <input type="file" class="my-pond" name="filepond" style="width: 20rem" />
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
              <div class="d-flex">
                <input type="text" class="form-control" id="inputName" name="name" disabled
                  value="{{ auth()->user()->name }}">
                <a class="btn" id="edit_name" style="margin-left: 20px"><i class="fa-solid fa-pen text-primary"></i></a>
              </div>
              @error('name')
              <p class="fw-bold text-danger">
                {{ $message }}
              </p>
              @enderror
            </div>

            <div class="col-md-12">
              <label for="inputEmail" class="form-label">Email</label>
              <div class="d-flex">
                <input type="email" class="form-control" id="inputEmail" name="email"
                  value="{{ auth()->user()->email }}" disabled>
                <a class="btn" id="edit_email" style="margin-left: 20px"><i
                    class="fa-solid fa-pen text-primary"></i></a>
              </div>
              @error('email')
              <p class="fw-bold text-danger">
                {{ $message }}
              </p>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </form>
    {{-- end profile info --}}
    <hr>
    @include('modal.add_movie')
    <div class="d-flex flex-row" style="gap: 20px">
      <button type="submit" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addMovie">Add movie
        <span><i class="fa-solid fa-plus"></i></span></button>

      <input type="file" id="csvFileInput" accept=".csv" style="display: none">
      <div>
        <button id="importMovieCsvButton" type="submit" class="btn btn-success mb-4">Import movie csv
          <span><i class="fa-solid fa-plus"></i></span></button>
        <span id="fileName" class="ms-2"></span>
        <span id="chooseFile" class="ms-2" style="display: none; cursor: pointer; color: green;"><i
            class="fa-solid fa-check"></i></span>
        <span id="removeFile" class="ms-2" style="display: none; cursor: pointer; color: red;">&times;</span>
      </div>
      <div>
        <button id="importSeatCsvButton" type="submit" class="btn btn-success mb-4">Import seats csv
          <span><i class="fa-solid fa-plus"></i></span></button>
        <span id="fileName" class="ms-2"></span>
        <span id="chooseFile" class="ms-2" style="display: none; cursor: pointer; color: green;"><i
            class="fa-solid fa-check"></i></span>
        <span id="removeFile" class="ms-2" style="display: none; cursor: pointer; color: red;">&times;</span>
      </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="movie-tab" data-bs-toggle="tab" data-bs-target="#movie-tab-pane"
          type="button" role="tab" aria-controls="movie-tab-pane" aria-selected="true">Movie</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profit-tab" data-bs-toggle="tab" data-bs-target="#profit-tab-pane" type="button"
          role="tab" aria-controls="profit-tab-pane" aria-selected="false">Profit</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      {{-- movie --}}
      <div class="tab-pane fade show active" id="movie-tab-pane" role="tabpanel" aria-labelledby="movie-tab"
        tabindex="0">
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
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $movie->id }}"><i
                    class="fa-solid fa-pen"></i></a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $movie->id }}"><i
                    class="fa-solid fa-trash" style="color: red"></i></a>
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
<script src="js/edit_admin_info.js"></script>
<script>
  $(function () {

    // First register any plugins
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    // Turn input element into a pond
    $('.my-pond').filepond();

    // Set allowMultiple property to true
    $('.my-pond').filepond('allowMultiple', true);


    $('.my-pond').on('FilePond:addfile', function (e) {
      const formData = new FormData();
      formData.append('profile_img', e.detail.file.file);

      fetch('/update_img', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
        .then(response => response.json())
        .then(data => {
          $("#mess").append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Update image successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
          setTimeout(() => {
            $('#mess').remove();
          }, 3000);

          $('#profile_img').attr('src', 'images/' + data.img_name);
        })
        .catch(error => {
          console.log("Error uploading file", error);
        })
    });

  });
</script>
@endsection