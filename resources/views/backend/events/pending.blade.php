<x-backend.layouts.master>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Donors</li>
            <li class="breadcrumb-item active">Donor-Requests</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pending events
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if ($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger text-center" role="alert">:message</div>')) !!}
            @endif
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Organized by</th>
                            <th>Event Date</th>
                            <th>Requested at</th>
                            <th>Uploaded By</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($eventsPending as $request)
                            <tr>
                                <td>{{ $request->title }}</td>
                                <td>{{ $request->organized_by }}</td>
                                <td>{{ $request->event_date }}</td>
                                <td>{{ $request->created_at }}</td>
                                <td>{{ $request->uploadedBy->name ?? 'Nixin'}}</td>
                                <td>{{ Str::limit( $request->description,20, '...')}}</td>
                                <td class="d-flex">

                                    <a href="" title="view" data-toggle="tooltip" data-placement="top"
                                        class="btn btn-info btn-sm" style="color: white"><i
                                            class="fa-solid fa-eye"></i></a>

                                    <a href="{{ route('event-request-accept', $request->id) }}" title="approve"
                                        class="btn btn-success btn-sm" style="margin-left: 3px"><i
                                            class="fas fa-check"></i></a>
                                        `
                                   <a href="{{route('event-request-decline' , $request->id)}}" title="decline" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-backend.layouts.master>