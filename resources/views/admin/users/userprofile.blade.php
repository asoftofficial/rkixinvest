@extends('admin.layouts.default')
@section('page-title')
  UserProfile
@endsection
@push('style')

@endpush
@push('script')
    <style>

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        {{--    Section Search Area    --}}
        <section class="admin-search-area">
            <div class="admin-search-left">

            </div>
            <div class="admin-search-right">
                <div class="admin-section-search-area input-group mb-3">
                    <input type="text" class="">
                    <div class="admin-section-search-btn-area">
                        <button class="btn bg-transparent mr-2" type="button"><i class="fas fa-search mr-2"></i> Search here</button>
                    </div>
                </div>
            </div>
        </section>
        {{--    End Section Search Area    --}}

        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area pb-5">
            <h2>CUSTOMERS DETAILS</h2>
            <p></p>
        </section>
        {{--    End Page Section Title Area    --}}
        <section class="adminside-profile">
            <h2>{{$user->first_name.' '.$user->last_name}}</h2>
            <div class="adminside-profile-info">
                <div class="col-md-12">
                    <h3>Profile</h3>
                    <p><strong>Customer ID:</strong> {{$user->customer_id}}</p>
                    <p><strong>Email address:</strong> {{$user->email}}</p>
                    <p><strong>Account created on:</strong> {{date('d/m/Y'), strtotime($user->created_at)}}</p>
                    <p><strong>Date of birth:</strong> {{$user->dob}}</p>
                    <p><strong>Address 1: </strong>{{$user->street1}}</p>
                    <p><strong>Address 2: </strong>{{$user->street2}}</p>
                    <p><strong>PostCode: </strong>{{$user->post_code}}</p>
                    <p><strong>City/Town:</strong> {{$user->city}}</p>
                    <p><strong>Country:</strong> {{$user->country?$user->country->name:''}}</p>
                </div>
            </div>
            {{-- <div class="adminside-plan-info">
                <h3>Subscription Plan</h3>
                <div class="adminside-plan-name">
                    {{$user->lisense?$user->lisense->plan->name:'Not Subscribed Yet'}}
                </div>
            </div> --}}
            <div class="adminside-billing-info mt-3">
                <h3>Subscription Details</h3>
                <div class="adminside-billin-info-inner">
                    <p><strong>Package name:</strong> new package</p>
                    <p><strong>remaining time:</strong> 2 days</p>
                    <p><strong>duration:</strong> 1 week</p>
                    <p><strong>investment</strong>4000 Usd</p>

                </div>
            </div>
        </section>


    </div>
    <!-- /.container-fluid -->

@endsection
