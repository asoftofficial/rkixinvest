@extends('admin.layouts.default')
@section('page-title')
User Management
@endsection
@section('header-right')
            <button
                class="btn btn-info px-3 blue-bg round-10"
                data-toggle="modal"
                data-target="#addUserModal">Add a User</button>
@endsection
@push('style')
@endpush
@push('script')
@endpush
@section('content')
<div class = "container-fluid" >
    {{-- Section Search Area    --}}
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area">
    <div>
        <h2>Users List</h2>
        <p>Latest Users information</p>
    </div>
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
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                     <td>{{$item->username}}</td>
                    <td>{{$item->first_name}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->email}}</td>
                    <td style="min-width: 256px">
                        <a href="{{route('admin.userprofile.show',$item->id)}}" class="mr-2 text-dark" style="font-size: 20px">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="user_email  btn btn-dark" data-toggle="modal" data-target="#userEmailModal-{{$item->id}}">
                            <i class="fas fa-envelope text-white" size="3"></i>
                        </a>
                    </td>
                </tr>
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
@endsection
