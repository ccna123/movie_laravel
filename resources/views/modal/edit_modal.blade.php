    <!-- Modal -->
    <div class="modal fade" id="exampleModal-{{ $movie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              {{-- edit detail --}}
              <form method="POST" action="/update_movie">
              <div class="form-floating mb-3">
                <input type="text" name="imdb" class="form-control" id="floatingImdb" value="{{ $movie->imdb_id }}">
                <label for="floatingImdb">Imdb</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="movie_name" class="form-control" id="floatingName" value="{{ $movie->name }}">
                <label for="floatingName">Name</label>
              </div>
              <div class="form-floating">
                <input type="number" name="ticket_fee" class="form-control" id="floatingFee" value="{{ $movie->ticket_fee }}">
                <label for="floatingFee">Fee</label>
              </div>
            </div>
              @csrf
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="movie_id" value="{{ $movie->id }}" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>