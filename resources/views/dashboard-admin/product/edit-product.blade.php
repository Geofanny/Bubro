<x-dashboard-admin>
    <h3>Product</h3>
    <hr>
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
        {{ $error }}
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/updateProduct/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Product</label>
            <input type="text" class="form-control" name="name" id="name" required="" value="{{$product->name}}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price Product</label>
            <input type="text" class="form-control" name="price" id="price" required="" value="{{$product->price}}">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category Product</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" disabled>Select Category</option>
                @if(!$categories->isEmpty())
                @foreach($categories as $category)
                <option value="{{ $category->id }}" class="text-capitalize" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    <span class="text-capitalize">{{ $category->name }}</span>
                </option>
                @endforeach
                @else
                <option value="" disabled>No Categories Available</option>
                @endif
            </select>
        </div>
        <div class="mb-3">
           <label for="image" class="form-label">Image Product</label>
           <input type="file" class="form-control mb-3" name="image" id="image" accept=".jpg, .jpeg, .png" id="image">
           <img src="{{ asset('product-image/' . $product->image) }}" id="img_show" 
           style="width: 20vh; border: 2px solid black;" alt="Product Image">
       </div>
       <div class="mb-3">
           <label for="stock" class="form-label">Stock Product</label>
           <input type="text" class="form-control" name="stock" id="stock" required="" value="{{$product->stock}}">
       </div>
       <div class="d-flex justify-content-between mb-5">
        <!-- Kembali Button -->
        <a href="/product-admin" class="btn btn-secondary">Back</a>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-dashboard-admin>

<x-script-admin>
    <script src="{{asset('js')}}/validation-input.js"></script>
    <script src="{{asset('js')}}/show-image.js"></script>
</x-script-admin>