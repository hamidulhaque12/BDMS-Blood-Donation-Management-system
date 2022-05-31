<x-backend.layouts.master>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Pending Blood Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                Blood Request
            </li>

        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Recent Requests
            </div>
            <div class="card-body">
                @if (session('message'))
                    <p class="alert alert-success">{{ session('message') }}</p>
                @endif

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Hostpital Name</th>
                            <th>BL Group</th>
                            <th>Area</th>
                            <th>Post Code</th>
                            <th>Reason</th>
                            <th>Unit</th>
                            <th>Request No</th>
                            <th>Requested at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($bloodRequests as $request)
                            <tr>
                                <td>{{ $request->patient_name }}</td>
                                <td>{{ $request->hospital_name }}</td>
                                <td>{{ $request->blood_group }}</td>
                                <td>{{ $request->district }}</td>
                                <td>{{ $request->postCode ?? 'N/A' }}</td>
                                <td>{{ Str::limit($request->reason, 30, '...') }}</td>
                                <td>{{ $request->blood_unit }}</td>
                                <td>{{ $request->request_no }}</td>
                                <td>{{ $request->created_at }}</td>
                                <td class="d-flex">

                                    <a href="{{ route('blood-view', $request->id) }}" title="view"
                                        class="btn btn-info btn-sm" style="color: white"><i
                                            class="fa-solid fa-eye"></i></a>

                                    <a href="{{ route('blood-approve', $request->id) }}" title="approve"
                                        class="btn btn-success btn-sm" style="margin-left: 3px"><i
                                            class="fas fa-toggle-off"></i></a>

                                    <a href="{{ route('blood-reject', $request->id) }}" title="reject"
                                        class="btn btn-danger btn-sm" style="margin-left: 3px"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.layouts.master>
