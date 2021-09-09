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
                @if(empty($settings->dlogo))
                    <a href="{{route('user.dashboard')}}"><img src="{{route('placeholder.image','200x80')}}"
                                alt="" /></a>
                @else
                     <a href="{{route('user.dashboard')}}"><img
                    src="{{$settings->dlogo}}"
                    class=""
                    alt="logo"></a>
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
                            href="{{route('user.dashboard')}}"
                            class="nav-link @if(Route::currentRouteName()=='user.dashboard') active pink-nav @endif">
                            <img src="{{asset('assets/backend/img/icons/dashboard-icon.png')}}" alt="">
                                <p>
                                    Dashboard
                                </p>
                            </a>
                    </li>
                        <li class="nav-item">
                            <a
                                href="{{route('user.investment')}}"
                                class="nav-link @if(Route::currentRouteName()=='user.investment') active lightblue-nav @endif">
                                <img src="{{asset('assets/backend/img/icons/invest.png')}}" alt="">
                                    <p>
                                        Investments
                                    </p>
                                </a>
                        </li>

                    <li class="nav-item">
                        <a
                            href="{{route('user.referrals')}}"
                            class="nav-link @if(Route::currentRouteName()=='user.referrals') active lightblue-nav @endif">
                            <img src="{{asset('assets/backend/img/icons/referral_icon.png')}}" alt="">
                            <p>
                                Referrals
                            </p>
                        </a>
                    </li>
                                <li class="nav-item">
                                    <a href="{{route('user.packages')}}" class="nav-link @if(Route::currentRouteName()=='user.packages') active blue-nav @endif">
                                        <img src="{{asset('assets/backend/img/icons/package-icon.png')}}" alt="">
                                            <p>Packages</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        href="{{route('user.transactions')}}"
                                        class="nav-link @if(Route::currentRouteName()=='user.transactions') active blue-nav @endif">
                                        <img src="{{asset('assets/backend/img/icons/transaction-icon.png')}}" alt="">
                                            <p>
                                                Transactions
                                            </p>
                                        </a>
                                </li>
                    <li class="nav-item">
                        <a
                            href="{{route('user.withdraw')}}"
                            class="nav-link @if(Route::currentRouteName()=='user.withdraw') active blue-nav @endif">
                            <img src="{{asset('assets/backend/img/icons/withdrawals.png')}}" alt="">
                            <p>
                                Withdraw
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="{{route('user.deposit')}}"
                            class="nav-link @if(Route::currentRouteName()=='user.deposit' ) active blue-nav @endif">
                            <img src="{{asset('assets/backend/img/icons/depositt.png')}}" alt="">
                            <p>
                                Deposit
                            </p>
                        </a>
                    </li>
                    @if (isOn('fund_transfer'))
                        <li class="nav-item">
                            <a
                                href="{{route('user.transfer')}}"
                                class="nav-link @if(Route::currentRouteName()=='user.transfer' ) active blue-nav @endif">
                                <img src="{{asset('assets/backend/img/icons/transaction-icon.png')}}" alt="">
                                <p>
                                    Transfer
                                </p>
                            </a>
                        </li>
                    @endif

                </ul>
        </nav>

    </div>

</aside>
