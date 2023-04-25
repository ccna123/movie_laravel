@extends('layout.header')

@section('content')
    <!-- Seat map -->
    <div class="container mt-4 seat_map">
        <div class="wrapper">
            <div class="mb-4">
                <a href="/" class="btn btn-primary px-4">Back</a>
            </div>
            <div class="screen text-center w-auto d-flex justify-content-center align-items-center" style="background-color: tomato; height: 10rem;">
                <h1>Screen</h1>
            </div>

            <div class="seats">
                <table class="table">
                    <thead>

                        <tr>
                            <th scope="col">No.</th>
                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                            
                                <th scope="col" class="text-center"><?= $i ?></th>
                            <?php endfor ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach (range("A", "H") as $char) : ?>
                            <tr>
                                <th scope="row"><?= $char ?></th>
                                <?php for ($j = 1; $j <= 8; $j++) : ?>
                                    <td class="text-center"><a href="#"><i id="<?= ($char . $j) ?>" class="fa-solid fa-couch"></i></a></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end seat map -->

    <!-- booking info -->
    <hr>
    <div class="d-flex align-items-center justify-content-center mb-3 container">   
            <h1>Fill in information</h1>
    </div>
    <form class="container w-50 mb-3">
        @csrf
        <div class="mb-3">
          <input type="text" class="form-control" id="cus_name" placeholder="Customer name" name="cus_name" required>
        @error('cus_name')
            <p class="text-danger">
                This field is required
            </p>
        @enderror
        </div>
       
        <div class="mb-3">
          <input type="email" class="form-control" id="cus_email" aria-describedby="emailHelp" placeholder="Email" name="email" required>
        @error('email')
          <p class="text-danger">
              This field is required
          </p>
        @enderror
        </div>
        <div>
            <input type="text" disabled class="form-control" id="seat_code" required name="seat_code">
        @error('seat_code')
          <p class="text-danger">
              This field is required
          </p>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary d-block w-100 mt-3" id="order">Submit</button>
      </form>
@endsection

@section('script')
    <script src="js/submit_order.js"></script>
@endsection
