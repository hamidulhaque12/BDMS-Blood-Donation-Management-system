<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{route('welcome')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                   Website
                </a>
                <div class="sb-sidenav-menu-heading">Manage</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Donors
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="">Donors Requests</a>
                        <a class="nav-link" href="">All donors</a>
                        <a class="nav-link" href="">Active Donors</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Blood
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#">
                            Blood container
                        </a>
                        
                        <a class="nav-link collapsed" href="#" >
                            Not approved requests
                        </a>
                    
                        <a class="nav-link collapsed" href="#">
                            Approved BL Requests
                        </a>
                     
                                          
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Uploads</div>
                <a class="nav-link" href="{{route('events.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Events
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>