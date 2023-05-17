<div>
    <div class="container">
        <h1>Customer Review</h1>
        <form class="row g-3" wire:submit.prevent='add'>
            <div class="form-group">
                <textarea 
                class="form-control" 
                style="resize: none; height: 10rem;" 
                id="exampleFormControlTextarea1"
                rows="3"     
                placeholder="Customer review" 
                wire:model.lazy="newComment"
                name="review_area"
                >
                </textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Post</button>
            </div>
        </form>
        @error('newComment')
            <span class="fw-bold text-danger">
                {{ $message }}
            </span>
        @enderror
        {{-- message --}}
        @if (session()->has('message'))
            
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        {{-- end message --}}
    </div>
    <hr>
    
    <div class="container">
        @foreach ($comments as $comment)

        <div class="wrapper border border-gray-500 rounded gap-2 mt-3">
            <div class="py-3 shadow">
                <div class="d-flex">
                    <h4 class="mx-4">{{ $comment->users->name}}</h4>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <p class="mx-4">
                        {{ $comment->content }}
                    </p>
                    <i class="fa-solid fa-trash fa-sm mx-4" style="color: #f91010; cursor: pointer;" wire:click="delete({{ $comment->id }})"></i>
            
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>