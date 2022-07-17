<x-backend.layouts.master>
    @if ($ongoing)
        <marquee width="max-width:250px" style="background-color: bisque"> <a href="">!!You have a ongoing donation activity!!</a> </marquee>
    @endif


    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        @if (auth()->user()->isAdmin() ||
            auth()->user()->isSuperAdmin())
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <p>Blood request Pending</p>
                            <Span>{{$bloodRequests ?? "No requests"}}</Span>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('request.notApproved')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <p>Donor Signup Request</p>
                            <Span>{{$signupRequests}}</Span>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('donor-request')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <p>Event Upload request</p>
                            
                            <Span>{{$eventRequests}}</Span>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('dashboard.events.pending') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <p class="text-center my-0 fw-bold">{{ date('Y-m-d') }}</p>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Total Donors</td>
                                        <td>:</td>
                                        <td>{{$totalDonors}}</td>
                                    </tr>
                                    <tr>
                                        <td>Available Donors</td>
                                        <td>:</td>
                                        <td>{{$availableDonors}}</td>
                                    </tr>
                                    <tr>
                                        <td>Blood Seekers</td>
                                        <td>:</td>
                                        <td>{{$bloodRequests}}</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        @endif



        <div class="row">
            <legend>Your Notifications</legend>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: rgb(157, 105, 28)">
                    <div class="card-body">
                        <p>Blood Request</p>
                        <span>{{ $usersBloodRequests ?? 'No requests' }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('donor-blood-reqs') }}">View
                            Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: rgb(155, 80, 95)">
                    <div class="card-body">
                        <p>Pending events</p>
                        <Span>0</Span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color:coral">
                    <div class="card-body">
                        <p>Your events</p>
                        <Span>0</Span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

        </div>
        @if (auth()->user()->isAdmin() ||
            auth()->user()->isSuperAdmin())
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Blood Donors Registration
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Blood request Traffic
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
        @endif

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('backend/assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/assets/demo/chart-bar-demo.js')}}"></script>
   

</x-backend.layouts.master>
