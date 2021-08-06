@extends('admin.layouts.default')
@section('page-title')
    Customer Profile
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
            <h2>{{$customer->first_name.' '.$customer->last_name}}</h2>
            <div class="adminside-profile-info">
                <div class="col-md-12">
                    <h3>Profile</h3>
                    <p>Customer ID: {{$customer->customer_id}}</p>
                    <p>Email address: {{$customer->email}}</p>
                    <p>Account created on: {{date('d/m/Y'), strtotime($customer->created_at)}}</p>
                    <p>Date of birth: {{$customer->dob}}</p>
                </div>
            </div>
            <div class="adminside-plan-info">
                <h3>Subscription Plan</h3>
                <div class="adminside-plan-name">
                    {{$customer->lisense?$customer->lisense->plan->name:'Not Subscribed Yet'}}
                </div>
            </div>
            <div class="adminside-billing-info">
                <h3>Billing Details</h3>
                <div class="adminside-billin-info-inner">
                    <p>Address 1: {{$customer->street1}}</p>
                    <p>Address 2: {{$customer->street2}}</p>
                    <p>PostCode: {{$customer->post_code}}</p>
                    <p>City/Town: {{$customer->city}}</p>
                    <p>Country: {{$customer->country?$customer->country->name:''}}</p>
                </div>
            </div>
        </section>


    </div>
    <!-- /.container-fluid -->

@endsection
