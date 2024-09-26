<x-dashboard-admin>
    <h3>Categories</h3>
    <hr>
    <div class="mb-3">
        <a href="/category-insert" class="btn btn-success">
            New Category +
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($categories->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No data available</td>
            </tr>
            @else
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td class="text-capitalize">{{$category->name}}</td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a href="/category-edit/{{$category->id}}" class="btn btn-primary">Edit</a>
                    <form action="/category-delete/{{ $category->id }}" method="POST" style="display:inline;" id="delete-form-{{ $category->id }}">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:;" class="btn btn-danger" onclick="confirmDeleteCategory({{ $category->id }})">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{ $categories->links() }} 
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