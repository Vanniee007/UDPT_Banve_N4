<header class="bg-light py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center phone-email">
                <div class="mr-3">
                    <i class="fas fa-phone-alt"></i> +84 6868 6868
                </div>
                <div>
                    <i class="fas fa-envelope"></i> tfour@gmail.com
                </div>
            </div>
            <div class="col-md-6 text-right social-icons">
                <a href="#" class="mr-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="mr-2"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col-md-2 logo">
                <a href="{{ route('home.index') }}">
                    <img src="{{ asset('frontend/images/logo1.png') }}" alt="Logo" class="img-fluid">
                </a>
            </div>
            <div class="col-md-4">
                <form class="form-inline">
                    <input class="form-control mr-sm-2 search-bar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('events.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('events.index') }}">Event</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('help.index') ? 'active' : '' }}">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Auth links outside navbar -->
                <div class="auth-links ml-3">
                    @if(Session::has('user'))
                        <span class="nav-link">Xin chào, {{ Session::get('user.username') }}</span>
                        <a href="{{ route('logout') }}" class="nav-link">Log Out</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log In</a>
                        <a href="#" class="nav-link">Sign Up</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
