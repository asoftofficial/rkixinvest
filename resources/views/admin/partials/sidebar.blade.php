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

    .angle-icon{
   top: 4px !important;
    right: -8px !important;
    }
</style>
<aside class="main-sidebar sidebar-light-primary">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div
            class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
            <div class="image">
                @if(empty($settings->logo))
                            <img src="{{route('placeholder.image','200x80')}}"
                                alt="" />
                @else
                     <img
                    src="{{$settings->logo}}"
                    class=""
                    alt="logo">
                @endif

            </div>
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

                <li class="nav-item align-items-center @if(Route::currentRouteName()=='admin.slider.index' ||Route::currentRouteName()=='admin.aboutus.settings' ||Route::currentRouteName()=='admin.how.to.settings' ||Route::currentRouteName()=='admin.testimonial.index') menu-is-opening menu-open @endif">
                    <a href=""
                    class="nav-link  @if(Route::currentRouteName()=='admin.slider.index' ||Route::currentRouteName()=='admin.aboutus.settings' ||Route::currentRouteName()=='admin.how.to.settings' ||Route::currentRouteName()=='admin.testimonial.index') active blue-nav @endif">
                    <img src="{{asset('/backend/img/icons/sections-icon.png')}}" alt="">
                        <p>
                        manage section
                        <i class="fas fa-angle-left right angle-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview text-bold oncollapse-sidebar open-sidebar" style="display:@if(Route::currentRouteName()=='admin.slider.index' ||Route::currentRouteName()=='admin.aboutus.settings' ||Route::currentRouteName()=='admin.how.to.settings' ||Route::currentRouteName()=='admin.testimonial.index') block @else none @endif">
                        <li class="nav-item">
                            <a href="{{route('admin.slider.index')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.slider.index') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.aboutus.settings')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.aboutus.settings') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>About us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.how.to.settings')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.how.to.settings') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>How To</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.testimonial.index')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.testimonial.index') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Testimonial</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item align-items-center @if(Route::currentRouteName()=='admin.email.template.global'||Route::currentRouteName()=='admin.email.template.index' ||Route::currentRouteName()=='admin.email.template.setting') menu-is-opening menu-open @endif">
                    <a href=""
                    class="nav-link @if(Route::currentRouteName()=='admin.email.template.global'||Route::currentRouteName()=='admin.email.template.index' ||Route::currentRouteName()=='admin.email.template.setting') active blue-nav @endif">
                    <img src="{{asset('/backend/img/icons/emailicon.png')}}" alt="">
                        <p>
                        Manage Emails
                        <i class="fas fa-angle-left right angle-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview oncollapse-sidebar open-sidebar text-bold" style="display: @if(Route::currentRouteName()=='admin.email.template.global'||Route::currentRouteName()=='admin.email.template.index' ||Route::currentRouteName()=='admin.email.template.setting') block @else none @endif">
                        <li class="nav-item">
                            <a href="{{route('admin.email.template.global')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.email.template.global') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Global Email</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.email.template.index')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.email.template.index') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Email Templates</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.email.template.setting')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.email.template.setting') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Email Configuration</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item align-items-center @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.general.info' ||Route::currentRouteName()=='admin.fund.settings' ||Route::currentRouteName()=='admin.referral.bonus' ||Route::currentRouteName()=='admin.show.kyc.settings' ||Route::currentRouteName()=='admin.deposit.geteways') menu-is-opening menu-open @endif">
                    <a href=""
                    class="nav-link @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.general.info' ||Route::currentRouteName()=='admin.fund.settings' ||Route::currentRouteName()=='admin.referral.bonus' ||Route::currentRouteName()=='admin.show.kyc.settings' ||Route::currentRouteName()=='admin.deposit.geteways') active blue-nav @endif">
                    <img src="{{asset('/backend/img/icons/settings.png')}}" alt="">
                        <p>
                        Settings
                        <i class="fas fa-angle-left right angle-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview oncollapse-sidebar open-sidebar text-bold" style="display: @if(Route::currentRouteName()=='admin.settings.index' || Route::currentRouteName()=='admin.general.info' ||Route::currentRouteName()=='admin.fund.settings' ||Route::currentRouteName()=='admin.referral.bonus' ||Route::currentRouteName()=='admin.show.kyc.settings' ||Route::currentRouteName()=='admin.deposit.geteways') block @else none @endif">
                        <li class="nav-item">
                            <a href="{{route('admin.settings.index')}}"
                            class="nav-link  @if(Route::currentRouteName()=='admin.settings.index') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                            <p>General Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.general.info')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.general.info') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                            <p>General Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.fund.settings')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.fund.settings') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Funds Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.referral.bonus')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.referral.bonus') active blue-nav @endif">
                            <img src="{{asset('backend/img/icons/child-link.png')}}" alt="">
                                <p>Referral Bonus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.show.kyc.settings')}}"
                            class="nav-link  @if(Route::currentRouteName()=='admin.show.kyc.settings') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>KYC Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.deposit.geteways')}}"
                            class="nav-link  @if(Route::currentRouteName()=='admin.deposit.geteways') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Deposit Gateways</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item align-items-center  @if(Route::currentRouteName()=='admin.withdraw.gateways'||Route::currentRouteName()=='admin.withdraw.gateways.create') menu-is-opening menu-open @endif">
                    <a href=""
                    class="nav-link @if(Route::currentRouteName()=='admin.withdraw.gateways'||Route::currentRouteName()=='admin.withdraw.gateways.create') active blue-nav @endif">
                    <img src="{{asset('/backend/img/icons/deposit.png')}}" alt="">
                        <p>
                      withdraw Method
                        <i class="fas fa-angle-left right angle-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview oncollapse-sidebar open-sidebar text-bold" style="display:  @if(Route::currentRouteName()=='admin.withdraw.gateways'||Route::currentRouteName()=='withdraw.gateways.create') block @else none @endif">
                        <li class="nav-item">
                            <a href="{{route('admin.withdraw.gateways')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.withdraw.gateways') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>View Method</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.withdraw.gateways.create')}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.withdraw.gateways.create') active blue-nav @endif">
                            <img src="{{asset('/backend/img/icons/child-link.png')}}" alt="">
                                <p>Add Method</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
