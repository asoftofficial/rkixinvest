<nav class="navbar navbar-expand-lg navbar-dark bg-light px-3 main-nav mt-3">
    <a class="navbar-brand" href="#">
        @if(empty($settings->logo))
            <img src="{{route('placeholder.image','200x80')}}"  alt="logo" />
        @else
            <img src="{{$settings->logo}}" class="" alt="logo">
        @endif
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-outline-blue d-inline-block px-5 round-20 mr-2" href="{{ route('login') }}">Login</a>
                <a class="nav-link btn banner-btn d-inline-block px-5" href="{{ route('register') }}">Register</a>
            </li>
        </ul>
    </div>
</nav>
