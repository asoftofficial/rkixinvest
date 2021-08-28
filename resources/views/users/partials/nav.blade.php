<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <p class="main-p" title="Balance"><i class="fas fa-wallet"></i> $ {{ round(Auth::user()->balance,2) }}</p>
    </li>
        <li class="nav-item">
            <p class="main-p">Hello! {{Auth::user()->username}}</p>
            <a href="#" class="dashboard-profile-image">
                <img src="{{Auth::user()->image}}" alt="">
            </a>
            <div class="dropdown main-drop profile-dropdown">
                <img  src="{{asset('backend/img/icons/bottom-angle.png')}}" class="dropdown-toggle bg-white border-0" type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('user.show.profile')}}">Profile</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
