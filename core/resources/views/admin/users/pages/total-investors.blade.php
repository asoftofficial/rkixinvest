@extends('admin.layouts.default')
@section('page-title')
Total Investors
@endsection
@push('style') <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script')
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script>
 <script>
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
@section('header-right')
    <a href="{{route('admin.show.active.investors')}}" class="btn btn-primary btn-blue header-right-btn">Active Investors</a>
@endsection
{{-- Page Section Title Area    --}}
<section class = "page-section-title-area" >
    <div>
        <h2>Total Investors List</h2>
        <p>Latest Investors Information</p>
    </div>
</section>{{-- End Page Section Title Area    --}}
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
                    <th scope="col">Amount
                    </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->investments->count()==0)
                        @php
                        continue;
                        @endphp
                    @endif
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->investments->count()}} | {{$user->investments->sum('amount').' '.'USD'}}</td>

                    <td style="min-width: 256px">
                        <a
                            href="{{route('admin.userprofile.show',$user->id)}}"
                            class="mr-2 text-dark"
                            style="font-size: 20px">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a
                            href="#"
                            class="user_email  btn btn-dark"
                            data-toggle="modal"
                            data-target="#userEmailModal-{{$user->id}}">
                            <i class="fas fa-envelope text-white" size="3"></i>
                        </a>
                       <a href="#" class="delete btn btn-dark" data-id="{{$user->id}}">
                            <i class='fas fa-trash-alt' style='font-size:20px;color:white;'></i>
                        </a>
                    </td>
                    </tr>
                    @include('admin.users.modals.eamil-to-investor')
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<form action = "" method = "post" id = "delete-form" >
    @csrf
@method('delete') </form>
@endsection
