<x-backend.layouts.master>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Events</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Events</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">

                <div class="row">
                    <div class="col-9">
                        <i class="fas fa-table me-1"></i>
                        Events list
                    </div>
                    <div class="col-3">
                        <a href="{{ route('events.create') }}" class="btn btn-outline-primary" role="button">Add new
                            Event</a>
                        <a href="" class="btn btn-outline-dark" role="button">Trash</a>
                    </div>
                </div>
            </div>
            @if (session('message'))
            <p class="alert alert-success">{{ session('message') }}</p>
        @endif
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Organized By</th>
                            <th>Uploaded_by</th>
                            <th>Approved_by</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->image }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ Str::limit($event->description,20, '...') }}</td>
                                <td>{{ $event->organized_by}}</td>
                                <td>{{ $event->uploadedBy->name }}</td>
                                <td>{{ $event->approvedBy->name }}</td>

                                <td class="d-flex">
                                    <a href="{{ route('events.show', $event->id) }}" role="button"
                                        class="btn btn-primary btn-sm">Show</a>
                                    <a href="" role="button" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('events.destroy', $event->id) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>





</x-backend.layouts.master>
