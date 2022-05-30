<x-backend.layouts.master>
    
    <div class="container-fluid px-4">
        <h1 class="mt-4">Blood Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                Blood Requests
            </li>
            <li class="breadcrumb-item active">    
                Pending
            </li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Requests
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>

                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Hostpital name</th>
                            <th>Area</th>
                            <th>Post code</th>
                            <th>Reason</th>
                            <th>Require Date</th>
                            <th>Requested at</th>
                            <th>Contact</th>
                         
                            <th>Action</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach ($pendingRequests as $request)

                        <tr>
                            <td>{{$request->patient_name}}</td>
                            <td>{{$request->gender}}</td>
                            <td>{{$request->hospital_name}}</td>
                            <td>{{$request->district}}</td>
                            <td>{{$request->postCode}}</td>
                            <td>{{ Str::limit($request->reason,15,'...')  }}</td>
                            <td>{{$request->require_date}}</td>
                            <td>{{$request->created_at}}</td>
                            <td>{{$request->phone}}</td>
                            
                            <td class="d-flex"> 
                                
                                <a href="" title="view" class="btn btn-info btn-sm">View</a> 
                                
                                @if ($request->status == null)
                                    <a href="{{route('donor-req-accept',$request->id)}}" title="take" class="btn btn-success btn-sm">Accept</a>
                                
                                @elseif($request->status == 1)
                                   <mark> Ongoing </mark>
                                
                                    
                                @elseif($request->status == 2)
                                    <mark> Donated </mark>
                                
                                @endif
                               
                                
                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.layouts.master>