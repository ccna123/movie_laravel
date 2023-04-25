@extends('layout.header')

@section('content')
<div id="mess"></div>
<div class="container mt-5 w-auto align-items-center d-flex justify-content-center">
    <form class="w-75" action="login" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email to login">
          @error('email')
              <p class="text-danger fw-bold">
                {{ $message }}
              </p>
          @enderror
        </div>
        <button type="submit" id="login" class="btn btn-primary mt-3 w-100">Login</button>
      </form>
</div>
@endsection

@section('script')
<script src="js/login.js"></script>
    
@endsection