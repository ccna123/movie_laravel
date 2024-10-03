    <!-- Modal -->
    <div class="modal fade" id="addMovie" tabindex="-1" aria-labelledby="addMovie" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addMovie">Add new movie</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              {{-- edit detail --}}
              <form method="POST" action="/addMovie">
              <div class="form-floating mb-3">
                <input type="text" name="imdb" class="form-control" id="floatingImdb" placeholder="Ex: tt123456">
                <label for="floatingImdb">Imdb</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="movie_name" class="form-control" id="floatingName" placeholder="Ex: ABC">
                <label for="floatingName">Name</label>
              </div>
              <div class="form-floating">
                <input type="number" name="ticket_fee" class="form-control" id="floatingFee" placeholder="Ex: 123$">
                <label for="floatingFee">Fee</label>
              </div>
            </div>
              @csrf
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>