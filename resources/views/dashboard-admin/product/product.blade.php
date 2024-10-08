<x-dashboard-admin>
    <h3>Product</h3>
    <hr>
    <div class="mb-3">
        <a href="/product-insert" class="btn btn-success">
            New Product +
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Image</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($products->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No data available</td>
            </tr>
            @else
            @foreach($products as $product)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td class="text-capitalize">{{$product->name}}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-capitalize">{{$product->category->name}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#imageModal-{{$product->id}}">
                        View Image
                    </button>
                    {{--  <img src="{{asset('product-image/'.$product->image)}}"> --}}
                </td>
                <td>{{ $product->created_at->format('d M Y | H:i') }}</td>
                <td>
                    <a href="/product-edit/{{$product->id}}" class="btn btn-primary">Edit</a>
                    <form action="/product-delete/{{ $product->id }}" method="POST" style="display:inline;" id="delete-form-{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:;" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>

        <!-- Modal -->
        @foreach($products as $product)
        <div class="modal fade" id="imageModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel-{{$product->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel-{{$product->id}}">Product Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('product-image/'.$product->image)}}" alt="Product Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $products->links() }} 
    </div>
</x-dashboard-admin>

<x-script-admin>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSuccessAlert('{{ session('success') }}');
        });
    </script>
    @endif

    <script src="{{ asset('js/confirm-delete.js') }}"></script>
</x-script-admin>