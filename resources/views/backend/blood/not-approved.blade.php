<x-backend.layouts.master>

    <style>
        #txtarea {
            display: none;
        }
    </style>
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

                                    <a data-bs-toggle="modal" data-bs-target="#reject{{ $request->id }}"
                                        href="" title="reject" class="btn btn-danger btn-sm"
                                        style="margin-left: 3px"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="reject{{ $request->id }}" tabindex="-1"
                                aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectLabel">Reject Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('blood-reject', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="modal-body">
                                                <p>Please mark a reason:</p>
                                                <div class="form-check">
                                                    <input onclick="hidetxt()" class="form-check-input" type="radio" name="reject_reason"
                                                        id="exampleRadios1" value="No certified documents">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        No certified documents
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input onclick="hidetxt()" class="form-check-input" type="radio" name="reject_reason"
                                                        id="exampleRadios2" value="No valid reasons">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        No valid reasons
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input onclick="showtxt()" class="form-check-input" type="radio"
                                                        name="reject_reason" id="exampleRadios3">
                                                    <label class="form-check-label" for="exampleRadios3">
                                                        Others
                                                    </label>

                                                </div>
                                                <textarea name="reject_reason" id="txtarea" cols="30" rows="2"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        function hidetxt(){
            document.getElementById("txtarea").style.display= "none";
        }
        function showtxt() {
            document.getElementById("txtarea").style.display= "block";
        }
    </script>

</x-backend.layouts.master>
