<x-dashboard-admin>
    <h3>Category</h3>
    <hr>
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
        {{ $error }}
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/category-update/{{$category->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Category</label>
            <input type="text" class="form-control" name="name" id="name" required="" value="{{$category->name}}">
        </div>
        <div class="d-flex justify-content-between mb-5">
            <!-- Kembali Button -->
            <a href="/category-admin" class="btn btn-secondary">Back</a>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</x-dashboard-admin>

<x-script-admin></x-script-admin>