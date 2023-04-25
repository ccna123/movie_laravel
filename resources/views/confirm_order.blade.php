@extends('layout.header')

@section('content')
    <div  id="mess">

    </div>
    <div class="container mt-4">
        <table class="table mt-5">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Movie</th>
                <th scope="col">Customer name</th>
                <th scope="col">Email</th>
                <th scope="col">Seat</th>
                <th scope="col">Total</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;  ?>
              @foreach ($data as $item)
              <tr id="{{ $index }}">
                <td>{{ $index }}</td>
                <td>{{ $item["movie_name"] }}</td>
                <td>{{ $item["cus_name"] }}</td>
                <td>{{ $item["cus_email"] }}</td>
                <td>{{ $item["seat_code"] }}</td>
                <td>{{ $item["ticket_fee_total"] }}</td>
                <td>  
                    <button value="{{ $item["movie_name"] }}" data-movie-name="{{ $item["movie_name"] }}" data-cus-email="{{ $item["cus_email"] }}" class="btn btn-danger cancel_btn">Cancel</button>
                </td>
            </tr>
            <?php $index++ ?>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection

@section('script')
    <script src="js/cancel.js"></script>
@endsection
