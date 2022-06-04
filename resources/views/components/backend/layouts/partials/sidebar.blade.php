<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('welcome') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Website
                </a>

                @if (Auth::user()->isAdmin()||Auth::user()->isSuperAdmin())
                    
               
                <div class="sb-sidenav-menu-heading">Manage</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Donors
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('donor-request') }}">Donors Requests</a>
                        <a class="nav-link" href="{{ route('donor.index') }}">All donors</a>
                        <a class="nav-link" href="{{ route('active-donor') }}">Active Donors</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Blood
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                        {{-- <a class="nav-link collapsed" href="#">
                            Blood container
                        </a> --}}
                        <a class="nav-link collapsed" href="{{route('request.notApproved')}}">
                            Pending BL Requests
                        </a>

                        <a class="nav-link collapsed" href="{{route('blood-request-all')}}">
                            Approved BL Requests
                        </a>


                    </nav>
                </div>
                
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages1"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Events
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages1" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{route('dashboard.events.pending')}}">
                            Pending Events
                        </a>
                        <a class="nav-link collapsed" href="{{route('events.create')}}">
                            Add a event
                        </a>

                        <a class="nav-link collapsed" href="{{route('events.index')}}">
                            Event list
                        </a>

                        <a class="nav-link collapsed" href="{{route('events.trash')}}">
                            Event trash
                        </a>


                    </nav>
                </div>
                @endif
                <div class="sb-sidenav-menu-heading">Your Activities</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Blood
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages2" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{route('donor-blood-reqs')}}">
                            Requests
                        </a>

                        <a class="nav-link collapsed" href="#">
                            Donation History
                        </a>


                    </nav>
                </div>
                <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapsePages4"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Events
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages4" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{route('events.create')}}">
                            Add a event
                        </a>

                        <a class="nav-link collapsed" href="#">
                           Your Event list
                        </a>

                    </nav>
                </div>
                
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->role->name }}
        </div>
    </nav>
</div>
