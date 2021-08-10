<style>
    ul#settings-list {
    list-style: none;
    padding: 5px;
    margin-top: -35px;

    }

    ul#settings-list > li{
        background: white;
    }
    </style>


<aside class="main-sidebar sidebar-light-primary">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
            <div class="image">
                <img src="{{asset('backend/img/dashboard-profile.png')}}" class="" alt="User Image">
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link @if(Route::currentRouteName()=='admin.dashboard') active pink-nav @endif">
                        <img src="{{asset('/backend/img/icons/dashboard-icon.png')}}" alt="">
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.userprofile.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.userprofile.index' || Route::currentRouteName()=='admin.userprofile.show') active lightblue-nav @endif">
                        <img src="{{asset('/backend/img/icons/user-icon.png')}}" alt="">
                        <p>
                          Users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.customers.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.customers.index' || Route::currentRouteName()=='admin.customers.show') active lightblue-nav @endif">
                        <img src="{{asset('/backend/img/icons/customers-icon.png')}}" alt="">
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.reward.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.reward.index' || Route::currentRouteName()=='admin.reward.show') active lightblue-nav @endif">
                        <img src="{{asset('/backend/img/icons/reward-icon.png')}}" alt="">
                        <p>
                           reward
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.banners.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.banners.index') active green-nav @endif">
                        <img src="{{asset('/backend/img/icons/banners-icon.png')}}" alt="">
                        <p>
                            Banners
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.issues.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.issues.index') active blue-nav @endif">
                        <img src="{{asset('/backend/img/icons/issues.icon.png')}}" alt="">
                        <p>
                            Issues
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.promotions.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.promotions.index') active yellow-nav @endif">
                        <img src="{{asset('/backend/img/icons/promotions-icon.png')}}" alt="">
                        <p>
                            Promotions
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.plans.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.plans.index' || Route::currentRouteName()=='admin.plans.show') active orange-nav @endif">
                        <img src="{{asset('/backend/img/icons/plans-icon.png')}}" alt="">
                        <p>
                            Plans
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.packages.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.packages.index' || Route::currentRouteName()=='admin.package.show') active blue-nav @endif">
                        <img src="{{asset('/backend/img/icons/package-icon.png')}}" alt="">
                        <p>
                            Packages
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.collections.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.collections.index') active pink-nav @endif">
                        <img src="{{asset('/backend/img/icons/collections-icon.png')}}" alt="">
                        <p>
                            Collections
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.magazines.index')}}" class="nav-link @if(Route::currentRouteName()=='admin.magazines.index') active red-nav @endif">
                        <img src="{{asset('/backend/img/icons/collections-icon.png')}}.
                        " alt="">
                        <p>
                            Magazines
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='admin.users') active dark-nav @endif">
                        <img src="{{asset('/backend/img/icons/collections-icon.png')}}.
                        " alt="">
                        <p>
                            User Managment
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="" class="nav-link dropdown-toggle @if(Route::currentRouteName()=='admin.users') active dark-nav @endif" id="settings">
                        <img src="/backend/img/icons/settings.png" alt="">
                        <p>
                           Settings
                        </p>
                    </a>

                </li> --}}

                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link  dropdown-toggle  @if(Route::currentRouteName()=='admin.users') active dark-nav @endif">
                        <img src="{{asset('/backend/img/icons/settings.png')}}" alt="">
                      <p>
                        Settings
                        {{-- <i class="right fas fa-angle-left"></i> --}}
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <li class="nav-item" >
                            <a  class="nav-link" href="{{route('admin.settings.index')}}" $id = "generalsettings" @if(Route::currentRouteName()=='admin.settings.index') active dark-nav @endif style="border:none;font-weight:bold;color:black;font-size:17px;" type="button" class="btn btn-white text-dark">
                                <b><img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="" ></b>
                                <p>
                                   General Settings
                                </p>
                            </a>

                             {{-- @include('admin.settings.generalsettings.modals.show'); --}}
                        </li>
                    </ul>
                  </li>



















            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    function (){
    $( "#settings" ).click(function myfunction() {
  $( "#settings-list" ).toggle();
});
    }
</script>


