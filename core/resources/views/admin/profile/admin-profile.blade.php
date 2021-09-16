@extends('admin.layouts.default')
@section('page-title')
Admin Profile
@endsection
@push('style')
@endpush
@push('script')
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="container emp-profile">
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        @if(empty(Auth::user()->image))
                            <img src="{{route('placeholder.image','360x360')}}"
                                alt="" />
                        @else
                            <img src="{{Auth::user()->image}}"
                                alt="" />
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h3>
                            {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                        </h3>
                        <h6>
                            {{'@'.Auth::user()->username}}
                        </h6>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-blue" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true" style="border-bottom: 2px solid #007bff">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                     <h5 class="text-bold mt-3 text-center">User actions</h5>

                    <input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"
                        data-toggle="modal" data-target="#UserProfileModal" />
                    <input type="button" class="profile-edit-btn mt-2" name="btnAddMore" value="Edit password"
                        data-toggle="modal" data-target="#editPasswordModal" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->id}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->username}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->email}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @include('admin.profile.modals.edit-profile')
            @include('admin.profile.modals.edit-password')
        </div>
    </div>
</div>
@endsection
