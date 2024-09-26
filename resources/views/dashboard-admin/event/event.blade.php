<x-dashboard-admin>
    <h3>Event</h3>
    <hr>
    <div class="mb-3">
        <a href="/event-insert" class="btn btn-success">
            New Event +
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Event date</th>
                    <th scope="col">Location</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($events->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No data available</td>
            </tr>
            @else
            @foreach($events as $event)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td class="text-capitalize">{{$event->title}}</td>
                <td class="text-capitalize">{{Str::limit($event->description,50)}}</td>
                <td class="text-capitalize">{{$event->event_date}}</td>
                <td class="text-capitalize">{{$event->location}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#imageModal-{{$event->id}}">
                        View Image
                    </button>
                    {{--  <img src="{{asset('event-image/'.$event->image)}}"> --}}
                </td>
                <td>{{ $event->created_at->format('d M Y | H:i') }}</td>
                <td>
                    <a href="/event-edit/{{$event->id}}" class="btn btn-primary">Edit</a>
                    <form action="/event-delete/{{ $event->id }}" method="POST" style="display:inline;" id="delete-form-{{ $event->id }}">
                        @csrf
                        @method('DELETE')
                        <a href="javascript:;" class="btn btn-danger" onclick="confirmDelete({{ $event->id }})">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </table>

        <!-- Modal -->
        @foreach($events as $event)
        <div class="modal fade" id="imageModal-{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel-{{$event->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel-{{$event->id}}">event Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('event-image/'.$event->image)}}" alt="event Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $events->links() }} 
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