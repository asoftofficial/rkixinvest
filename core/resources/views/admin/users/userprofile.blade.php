@extends('admin.layouts.default')
@section('page-title')
User profile
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css')}}">
<style>
    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        /* border-radius: 10px; */
        width: 90%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
        margin-left: 17px;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }

    div#user_action {
    background-color: whitesmoke;
    padding: 5px 5px 5px 10px;
}
</style>
@endpush

@push('script')
    <script src="{{asset('assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
<script>
    $(".blocked_user").click(function (e) {
    swal(
        {title: "Are you sure ?", text: "you want to apply this opreation", icon: "warning", buttons: true, dangerMode: true}
    ).then((willUpdate) => {
        if (willUpdate) {
            var user_id = $(this).attr('data-id');
            var url = "{{route('admin.blocked.user', 'id')}}";
            url = url.replace('id', user_id);
            $("#update-form").attr('action', url);
            $("#update-form").submit();
        }
    });
});
</script>
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
                        @if(empty($user->image))
                            <img src="{{route('placeholder.image','360x360')}}"
                                alt="" />
                        @else
                            <img src="{{$user->image}}"
                                alt="" />
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h3>
                            {{$user->first_name}} {{$user->last_name}}
                        </h3>
                        <h6>
                            {{'@'.$user->username}}
                        </h6>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-blue" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true" style="border-bottom: 2px solid #007bff !important;">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <h5 class="text-bold mt-3 text-center">User actions</h5>
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" data-toggle="modal" data-target="#UserProfileModal" />
                        <input type="button" class="profile-edit-btn mt-2" name="btnAddMore" value="Edit password" data-toggle="modal" data-target="#editPasswordModal" />
                        <input type="button" class="profile-edit-btn mt-2 blocked_user" name="btnAddMore" data-id="{{$user->id}}" @if($user->blocked == 1) value="Active" @else value="Suspended" @endif/>
                        <input type="button" class="profile-edit-btn mt-2" data-toggle="modal" data-target="#userEmailModal-{{$user->id}}" value="Send Mail"><br/>
                        <input type="button" class="profile-edit-btn mt-2" data-toggle="modal" data-target="#userFundsModal" value="Add & Subtract balance"><br/>
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
            @include('admin.users.modals.edit')
            @include('admin.users.modals.funds')
            @include('admin.users.modals.edit-password')
            @include('admin.users.pages.send-mail')

        </div>
    </div>
</div>
                        {{-- submiting a form through js for block unblock button --}}
                        <form action="" method="post" id="update-form">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                         </form>
@endsection
