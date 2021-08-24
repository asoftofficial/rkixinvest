@extends('admin.layouts.default')
@section('page-title')
User Management
@endsection
@push('style')
<link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script')
<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js" > </script>
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


$(".delete").click(function (e) {
    console.log("asdhsakdash")
    swal(
        {title: "Are you sure ?", text: "Once Deleted it can not be reverted", icon: "warning", buttons: true, dangerMode: true}
    ).then((willDelete) => {
        if (willDelete) {
            var user_id = $(this).attr('data-id');
            var url = "{{route('admin.userprofile.destroy', 'id')}}";
            url = url.replace('id', user_id);
            $("#delete-form").attr('action', url);
            $("#delete-form").submit();
        }
    });
});
</script>
@endpush
@section('content')
<div class = "container-fluid" > {{-- Section Search Area    --}}
    <section class = "admin-search-area" >
        <div class="admin-search-left">
            <button
                class="btn btn-info px-3 blue-bg round-10"
                data-toggle="modal"
                data-target="#addUserModal">Add a User</button>
        </div>
        <div class="admin-search-right">
            <div class="admin-section-search-area input-group mb-3">
                <input type="text" class="">
                    <div class="admin-section-search-btn-area">
                        <button class="btn bg-transparent mr-2" type="button">
                            <i class="fas fa-search mr-2"></i>
                            Search here</button>
                    </div>
            </div>
        </div>
    </section>{{-- End Section Search Area    --}}

{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" > <div>
    <h2>Reward List</h2>
    <p>Latest reward information</p>
</div>
</section>
{{-- End Page Section Title Area    --}}
<section class = "collections" >
    <div class="table-responsive">
        <table class="table custom-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">User ID
                    </th>
                    <th scope="col">First Name
                    </th>
                    <th scope="col">Last Name
                    </th>
                    <th scope="col">Email Address
                    </th>
                    <th scope="col">role</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->first_name}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->email}}</td>

                    <td>{{$item->role}}</td>

                    <td style="min-width: 256px">
                        <a
                            href="{{route('admin.userprofile.show',$item->id)}}"
                            class="mr-2 text-dark"
                            style="font-size: 20px">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($item->blocked == 0)
                        <a href="#" class="btn btn-danger blocked_user" data-id="{{$item->id}}">
                            <p class="text-white block_button" style="font-size: 17px;height:0.8vh; ">Blocked</p>
                        </a>
                        @else
                        <a href="#" class="btn btn-success blocked_user " data-id="{{$item->id}}">
                            <p class="text-white block_button" style="font-size: 17px;height:1vh;">Unblock</p>
                        </a>
                        @endif
                        <a
                            href="#"
                            class="user_email  btn btn-dark"
                            data-toggle="modal"
                            data-target="#userEmailModal-{{$item->id}}">
                            <i class="fas fa-envelope text-white" size="3"></i>
                        </a>
                       <a href="#" class="delete btn btn-dark" data-id="{{$item->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:white;'></i>
                        </a>
                    </td>
                </tr>
                <form action="" method="post" id="update-form">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="user_id"></form>
                    @include('admin.users.modals.email')

                    @endforeach

            </tbody>
        </table>
    </div>
</section>

</div>
<!-- /.container-fluid -->

{{-- Add User Model  --}}
@include("admin.users.modals.create")
<form action = "" method = "post" id = "delete-form" >
    @csrf
@method('delete') </form>


@endsection
