@extends('admin.layouts.default')
@section('page-title')
Total Investors
@endsection
@push('style')
@endpush
@push('script')
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
                    <th scope="col">Investments
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
                    </td>
                    </tr>
                    @include('admin.users.modals.eamil-to-investor')
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
