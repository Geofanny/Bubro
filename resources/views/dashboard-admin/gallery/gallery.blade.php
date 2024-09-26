<x-dashboard-admin>
    <h3>Gallery</h3>
    <hr>
    <div class="mb-3">
        <a href="/gallery-insert" class="btn btn-success">
            New Gallery +
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($galleries->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No data available</td>
            </tr>
            @else
            @foreach($galleries as $gallery)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td class="text-capitalize">{{$gallery->title}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#imageModal-{{$gallery->id}}">
                        View Image
                    </button>
                    {{--  <img src="{{asset('gallery-image/'.$gallery->image)}}"> --}}
                </td>
                <td>{{ $gallery->created_at->format('d M Y | H:i') }}</td>
                <td>
                    <a href="/gallery-edit/{{$gallery->id}}" class="btn btn-primary">Edit</a>
                    <form action="/gallery-delete/{{ $gallery->id }}" method="POST" style="display:inline;" id="delete-form-{{ $gallery->id }}">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:;" class="btn btn-danger" onclick="confirmDelete({{ $gallery->id }})">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>

        <!-- Modal -->
        @foreach($galleries as $gallery)
        <div class="modal fade" id="imageModal-{{$gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel-{{$gallery->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel-{{$gallery->id}}">gallery Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('gallery-image/'.$gallery->media_path)}}" alt="gallery Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-end">
        {{ $galleries->links() }} 
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