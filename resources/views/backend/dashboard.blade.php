<x-backend.layouts.master>


   
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() )
     


        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p>Blood request approval</p>
                        <Span>30</Span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body"><p>Donor Signup Request</p>
                        <Span>30</Span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body"><p>Total Upload request</p>
                        <Span>30</Span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="text-center my-0 fw-bold">{{date('Y-m-d')}}</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Total Donors</td>
                                    <td>:</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>Available Donors</td>
                                    <td>:</td>
                                    <td>70</td>
                                </tr>
                                <tr>
                                    <td>Blood Seekers</td>
                                    <td>:</td>
                                    <td>40</td>
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
                        <span>{{$usersBloodRequests ?? 'No requests'}}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('donor-blood-reqs')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color: rgb(155, 80, 95)">
                    <div class="card-body"><p>Pending events</p>
                        <Span>30</Span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4" style="background-color:coral">
                    <div class="card-body"><p>Your events</p>
                        <Span>30</Span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            
        </div>
        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
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

</x-backend.layouts.master>