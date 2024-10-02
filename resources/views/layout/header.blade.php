<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

  <title>Movie Booking</title>
  @livewireStyles
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Thanh's Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="/checking_booking">Check Booking</a>
            </li>
            
            @can('admin_auth', Auth::user())
                
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="/admin">Dashboard</a>
            </li>
            @endcan
            
          </ul>
          <ul class="navbar-nav ml-auto">
            @auth
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="{{ url('/confirm_order?email=' . auth()->user()->email) }}">Welcome {{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item">
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="nav-link text-light fw-bold">Logout</button>
              </form>
            </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </div>
  {{-- end navbar --}}
  <div>
    @yield('content')
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- include FilePond library -->
  <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

  <!-- include FilePond plugins -->
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

  <!-- include FilePond jQuery adapter -->
  <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
  @yield('script')
  @extends('layout.footer')
  @livewireScripts
</body>