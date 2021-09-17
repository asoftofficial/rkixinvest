<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="nav_icon" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <p class="main-p">Welcome {{auth::user()->username}}</p>
            <a href="#" class="dashboard-profile-image">
                @if(empty(auth::user()->image))
                    <img src="{{route('placeholder.image','200x200')}}" alt=""/>
                @else
                    <img src="{{auth::user()->image}}" alt="" style="max-height:50px;max-width:50px;border-radius:50%;">
                @endif

            </a>
            <div class="dropdown main-drop profile-dropdown">
                <img src="{{asset('assets/backend/img/icons/bottom-angle.png')}}"
                     class="dropdown-toggle bg-white border-0" type="text" id="dropdownMenuButton"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('admin.profile')}}">Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
