<style>
    ul#settings-list {
        list-style: none;
        padding: 5px;
        margin-top: -35px;

    }

    ul#settings-list > li {
        background: white;
    }

    p#generalsettings_text {
    position: relative;
    right: -5rem;
    top: -4vh;
}
</style>

<aside class="main-sidebar sidebar-light-primary">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div
            class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
            <div class="image">
                <img
                    src="{{asset('backend/img/dashboard-profile.png')}}"
                    class=""
                    alt="User Image"></div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any
                    other icon font library -->
                    <li class="nav-item">
                        <a
                            href="{{route('user.dashboard')}}"
                            class="nav-link @if(Route::currentRouteName()=='user.dashboard') active pink-nav @endif">
                            <img src="{{asset('/backend/img/icons/dashboard-icon.png')}}" alt="">
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                href="{{route('admin.userprofile.index')}}"
                                class="nav-link @if(Route::currentRouteName()=='admin.userprofile.index' || Route::currentRouteName()=='admin.userprofile.show') active lightblue-nav @endif">
                                <img src="{{asset('/backend/img/icons/user-icon.png')}}" alt="">
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a
                                    href="{{route('admin.reward.index')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.reward.index' || Route::currentRouteName()=='admin.reward.show') active lightblue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/reward-icon.png')}}" alt="">
                                        <p>
                                            Rewards
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a
                                        href="{{route('user.packages')}}"
                                        class="nav-link @if(Route::currentRouteName()=='user.packages' || Route::currentRouteName()=='user.package.show') active blue-nav @endif">
                                        <img src="{{asset('/backend/img/icons/package-icon.png')}}" alt="">
                                            <p>
                                                Packages
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <img src="{{asset('/backend/img/icons/settings.png')}}" alt="">
                                                <p>
                                                    Settings
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a
                                                        href="{{route('admin.settings.index')}}"
                                                        @if(Route::currentRouteName()=='admin.users')
                                                        active="active"
                                                        dark-nav="dark-nav"
                                                        @endif
                                                        class="btn btn-white text-dark"
                                                        style="border:none;font-weight:bold;color:black;font-size:17px;"
                                                        type="button">
                                                        <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                                            <p id="generalsettings_text">general settings</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- /.sidebar-menu -->
                                </div>
                                <!-- /.sidebar -->
                            </aside>
