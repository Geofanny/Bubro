<x-dashboard-admin>
    <h3>Gallery</h3>
    <hr>
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
        {{ $error }}
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/gallery-update/{{$gallery->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="name" required="" value="{{$gallery->title}}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control mb-3" name="media_path" id="image" accept=".jpg, .jpeg, .png">
            <img src="{{ asset('gallery-image/' . $gallery->media_path) }}" id="img_show" width="20vh"
            style="width: 20vh; border: 2px solid black;">
        </div>
        <div class="d-flex justify-content-between mb-5">
            <!-- Kembali Button -->
            <a href="/gallery-admin" class="btn btn-secondary">Back</a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</x-dashboard-admin>

<x-script-admin>
    <script src="{{asset('js')}}/show-image.js"></script>
</x-script-admin>