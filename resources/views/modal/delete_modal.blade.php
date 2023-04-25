<!-- Modal -->
<div class="modal fade" id="deleteModal-{{ $movie->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you want to delete {{ $movie->name }}
        </div>
        <form action="/delete_movie" method="post">
          @csrf
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="movie_id" value="{{ $movie->id }}" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>