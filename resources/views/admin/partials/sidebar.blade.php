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
        padding-left: 5px;
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
                            href="{{route('admin.dashboard')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.dashboard') active pink-nav @endif">
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
                                        href="{{route('admin.packages.index')}}"
                                        class="nav-link @if(Route::currentRouteName()=='admin.packages.index' || Route::currentRouteName()=='admin.package.show') active blue-nav @endif">
                                        <img src="{{asset('/backend/img/icons/package-icon.png')}}" alt="">
                                            <p>
                                                Packages
                                            </p>
                                        </a>
                                    </li>
                                </li>
                                <li class="nav-item align-items-center">
                                <a href=""
                                class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                <img src="{{asset('/backend/img/icons/sections-icon.png')}}" alt="">
                                  <p>
                                   manage section
                                    <i class="fas fa-angle-left right"></i>
                                  </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                     <li class="nav-item">
                                    <a href="{{route('admin.slider.index')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                      <p>Slider</p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="{{route('admin.aboutus.settings')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                      <p>about us</p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="{{route('admin.how.to.settings')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                      <p>how-to</p>
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a href="{{route('admin.testimonial.index')}}"
                                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.settings.show') active blue-nav @endif">
                                    <img src="{{asset('/backend/img/icons/generalsettings.png')}}" alt="">
                                      <p>testimonial</p>
                                    </a>
                                  </li>

                                </ul>
                                </li>
                                   <li class="nav-item">
                                <a href=""
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
                                  <li class="nav-item ml-2">
                                    <a href="{{route('admin.general.info')}}"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/info-icon.png')}}" alt="">
                                      <p>General info</p>
                                    </a>
                                  </li>
                                   <li class="nav-item ml-2">
                                    <a href="{{route('admin.show.email.settings')}}"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/emailicon.png')}}" alt="">
                                      <p>Email settings</p>
                                    </a>
                                  </li>
                                  <li class="nav-item ml-2">
                                    <a href="/maileclipse"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/emailicon.png')}}" alt="">
                                      <p>Edit Emails</p>
                                    </a>
                                  </li>
                                   <li class="nav-item ml-2">
                                    <a href="{{route('admin.fund.settings')}}"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/fundicon.png')}}" alt="">
                                      <p>Funds settings</p>
                                    </a>
                                  </li>
                                  <li class="nav-item ml-2">
                                    <a href="{{route('admin.referral.bonus')}}"
                                    class="nav-link">
                                    <img src="{{asset('backend/img/icons/referral_icon.png')}}" alt="">
                                      <p>Referral bonus</p>
                                    </a>
                                  </li>
                                   <li class="nav-item ml-2">
                                    <a href="{{route('admin.show.kyc.settings')}}"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/kycicon.png')}}" alt="">
                                      <p>KYC settings</p>
                                    </a>
                                  </li>
                                  <li class="nav-item ml-2">
                                    <a href="{{route('admin.deposit.geteways')}}"
                                    class="nav-link">
                                    <img src="{{asset('/backend/img/icons/kycicon.png')}}" alt="">
                                      <p>Deposit Gateways</p>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                </ul>
            </nav>
    </div>
</aside>






















