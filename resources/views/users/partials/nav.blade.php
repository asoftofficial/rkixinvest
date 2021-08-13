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
            <p class="main-p">{{Auth::user()->username}}</p>
            <a href="#" class="dashboard-profile-image">
                <img src="{{asset('frontend/dashboard/img/avatar5.png')}}" alt="">
            </a>
            <div class="dropdown main-drop profile-dropdown">
                <img  src="{{asset('backend/img/icons/bottom-angle.png')}}" class="dropdown-toggle bg-white border-0" type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
            </div>
            <!-- <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a> -->
        </li>
        <!-- <li class="nav-item">
        <a href="#"><i class="fas fa-user"></i></a> -->
        <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
        </a> -->
        <!-- </li> -->

        <!-- <li class="nav-item">

        </li> -->
    </ul>
</nav>
<!-- /.navbar -->
