@extends('admin.layouts.default')
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
@push('script')
    <script src="{{asset('assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
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
                            <input type="button" class="btn btn-secondary btn-block" name="btnAddMore" value="Edit Profile" data-toggle="modal" data-target="#UserProfileModal" />
                            <input type="button" class="btn btn-secondary btn-block" name="btnAddMore" value="Edit password" data-toggle="modal" data-target="#editPasswordModal" />
                            <input type="button" class="btn btn-secondary btn-block blocked_user" name="btnAddMore" data-id="{{$user->id}}" @if($user->blocked == 1) value="Active" @else value="Suspended" @endif/>
                            <input type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#userEmailModal-{{$user->id}}" value="Send Mail">
                            <input type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#userFundsModal" value="Add & Subtract balance"><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
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
            @include('admin.users.modals.edit')
            @include('admin.users.modals.funds')
            @include('admin.users.modals.edit-password')
            @include('admin.users.pages.send-mail')
    {{-- submiting a form through js for block unblock button --}}
    <form action="" method="post" id="update-form">
        @csrf
        <input type="hidden" value="{{$user->id}}" name="user_id">
    </form>
@endsection
