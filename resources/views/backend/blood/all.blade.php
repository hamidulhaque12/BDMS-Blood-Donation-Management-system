<x-backend.layouts.master>

    <div class="container-fluid px-4">
        <h1 class="mt-4">All Blood Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                Blood Request
            </li>
            <li class="breadcrumb-item active">
                Approved
            </li>

        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Recent Requests (Approved)
            </div>
            <div class="card-body">
                @if (session('message'))
                    <p class="alert alert-success">{{ session('message') }}</p>
                @endif

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>BL Group</th>
                            <th>Area</th>
                            <th>Post Code</th>
                            <th>Unit</th>
                            <th>Request No</th>
                            <th>Requested at</th>
                            <th>Approved by</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($bloodRequests as $request)
                            <tr>
                                <td>{{ $request->patient_name }}</td>
                                <td>{{ $request->blood_group }}</td>
                                <td>{{ $request->district }}</td>
                                <td>{{ $request->postCode ?? 'N/A' }}</td>
                            
                                <td>{{ $request->blood_unit }}</td>
                                <td>{{ $request->request_no }}</td>
                                <td>{{ $request->created_at->diffForHumans()}}</td>
                                <td>{{$request->approvedBy->name}}</td>
                                <td>
                                    @if ($request->status == Null)
                                        <span class="badge bg-info" style="color: aliceblue">Pending</span>
                                    @elseif($request->status == 1)
                                        <span class="badge bg-warning btn-sm" style="color: aliceblue">Assigned</span>
                                    @elseif($request->status == 2)
                                        <span class="badge" style="background-color: cadetblue" style="color: aliceblue">Taken</span>
                                    @elseif($request->status == 3)
                                        <span class="badge" style="background-color: rgb(4, 154, 7)" style="color: aliceblue">Donated</span>
                                        @elseif($request->status == 0)
                                        <span class="badge" style="background-color:fuchsia"style="color: aliceblue">Cancelled</span>
                                    @endif


                                </td>
                                <td >
                                    @if ($request->status == Null)
                                   
                                        <a href="{{route('request-assign', $request->id) }}" title="assign"
                                            class="btn btn-warning  w-100 " >Assign</a>
                                        <div class="d-flex">
                                            <a href="{{route('blood-view', $request->id) }}" title="view"
                                                class="btn btn-info btn-sm" style="color: white"><i
                                                    class="fa-solid fa-eye"></i></a>
        
                                            <a href="{{route('blood-approve', $request->id) }}" title="edit"
                                                class="btn btn-success btn-sm" style="margin-left: 3px"><i
                                                    class="fas fa-pencil"></i></a>
        
                                            <a href="{{route('blood-reject',$request->id)}}" title="delete" class="btn btn-danger btn-sm" style="margin-left: 3px"><i
                                                    class="fas fa-trash"></i></a>
                                        </div>
                                       
                                    @endif

                                    @if ($request->status >= 1)
                                    <a href="{{route('blood-view', $request->id) }}" title="view"
                                        class="btn btn-info btn-sm" style="color: white"><i
                                            class="fa-solid fa-eye"></i></a>
                                    @endif
                                    
                                   

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.layouts.master>
