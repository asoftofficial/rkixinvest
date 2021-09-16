@extends('users.layouts.default')
@section('page-title')
User Profile
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
<style>
    div#user_action {
    background-color: whitesmoke;
    padding: 5px 5px 5px 10px;
}
</style>
@endpush

@section('content')
<section>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 p-1">
                        <div class="profile-img">
                            @if(empty($user->image))
                                <img src="{{route('placeholder.image','360x360')}}" alt="" />
                            @else
                                <img src="{{$user->image}}" alt="" />
                            @endif
                        </div>
                          <div class="profile-work">
                           <h5 class="text-bold mt-3 text-center">User actions</h5>
                            <input type="button" class="btn btn-secondary btn-block" name="btnAddMore" value="Edit Profile"  data-toggle="modal" data-target="#UpdateProfileModal"/>
                            <input type="button" class="btn btn-secondary btn-block" name="btnAddMore" value="Edit password" data-toggle="modal" data-target="#editPasswordModal" />
                            <input type="button" class="btn btn-secondary btn-block" name="btnAddMore" value="Transaction Code" data-toggle="modal" data-target="#trxUpdatedModal" />
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                            <div class="profile-head ml-4">
                                <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                                <h6>{{'@'.$user->username}}</h6>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="border-bottom: 2px solid #007bff">About</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content profile-tab ml-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->username}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->first_name}} {{$user->last_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        @include('users.profile.modals.edit-profile')
        @include('users.profile.modals.edit-password')
        @include('users.profile.modals.trx-code-update')
@endsection
