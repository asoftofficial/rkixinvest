@extends('admin.layouts.default')
@section('page-title')
Active Users
@endsection
@section('header-right')
        <div class="admin-search-left">
            <button
                class="btn btn-info px-3 blue-bg round-10"
                data-toggle="modal"
                data-target="#addUserModal">Add a User</button>
@endsection
@push('script')
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
<div class = "container-fluid" >
    {{-- Section Search Area    --}}
    {{-- Page Section Title Area    --}}
    <section class = "page-section-title-area" >
        <h2>Active Users List</h2>
        <p>Latest Users information</p>
    </section>
    {{-- End Page Section Title Area    --}}
    <section class = "collections" >
        <div class="table-responsive">
            <table class="table custom-table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#ID
                    </th>
                    <th scope="col">Username
                    </th>
                    <th scope="col">First Name
                    </th>
                    <th scope="col">Last Name
                    </th>
                    <th scope="col">Email Address
                    </th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($active_users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->role}}</td>
                            <td style="min-width: 256px">
                                <a href="{{route('admin.userprofile.show',$item->id)}}" class="mr-2 text-dark" style="font-size: 20px">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                    </tr>
                        <form action="" method="post" id="update-form">
                        @csrf
                        <input type="hidden" value="{{$item->id}}" name="user_id">
                    </form>
                    @include('admin.users.modals.email')
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
<!-- /.container-fluid -->

@include("admin.users.modals.create")
{{-- <form action = "" method = "post" id = "delete-form" >
    @csrf
@method('delete') </form> --}}
@endsection
