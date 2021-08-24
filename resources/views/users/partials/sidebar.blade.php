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
                                    <a
                                        href="{{route('user.transactions')}}}"
                                        class="nav-link">
                                        <img src="{{asset('/backend/img/icons/transaction-icon.png')}}" alt="">
                                            <p>
                                                Transactions
                                            </p>
                                        </a>
                                </li>
                                <li class="nav-item">
                                <a href="{{route('admin.settings.index')}}"
                                class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                <img src="{{asset('/backend/img/icons/settings.png')}}" alt="">
                                  <p>
                                   Settings
                                    <i class="fas fa-angle-left right"></i>
                                  </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">

                                  <li class="nav-item ml-2">
                                    <a href="{{route('admin.settings.index')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                      <p>general settings</p>
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
