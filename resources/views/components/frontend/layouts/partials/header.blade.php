<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav d-flex w-100 justify-content-between ">

            <div class="d-flex">
                <a href="{{route('welcome')}}" class="nav-item nav-link">Home</a>
                <a href="{{ route('events') }}" class="nav-item nav-link">Events</a>
                <a href="{{route('bloodreq-user')}}" class="nav-item nav-link">Blood Request</a>
                <a href="#" class="nav-item nav-link">About Us</a>
                <a href="#" class="nav-item nav-link">Contact Us</a>
            </div>


            <div class="d-flex ">
                <a class="nav-item nav-link" href="{{ route('login') }}" role="button" aria-expanded="false">
                    Login
                </a>
                <a class="nav-item nav-link" href="{{route('register')}}" aria-expanded="false">
                    Donor Sign Up!
                </a>

                <a class="nav-item nav-link" href="{{route('dashboard')}}" role="button" aria-expanded="false">
                    Dashboard
                </a>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a  class="nav-item nav-link" href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                </a>
                </form>
            </div>


        </div>


    </div>

    </div>
</nav>
