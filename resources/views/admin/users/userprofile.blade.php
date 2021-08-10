@extends('admin.layouts.default') @section('page-title') UserProfile @endsection
@push('style') @endpush @push('script') @endpush @section('content')
<div class="container-fluid">
    {{--    Section Search Area    --}}
    <section class="admin-search-area">
        <div class="admin-search-left"></div>
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
    </section>
    {{--    End Section Search Area    --}}

    {{--    User Details   --}}
    <section class="adminside-profile">
        <h2 class="mt-3 mb-3">{{$user->first_name.' '.$user->last_name}}</h2>
        <div class="adminside-profile-info">
            <div class="col-md-12">

                <p>
                    <strong>Customer ID:</strong>
                    {{$user->customer_id}}</p>
                <p>
                    <strong>Email address:</strong>
                    {{$user->email}}</p>
                <p>
                    <strong>Account created on:</strong>
                    {{date('d/m/Y'), strtotime($user->created_at)}}</p>
                <p>
                    <strong>Date of birth:</strong>
                    {{$user->dob}}</p>
                <p>
                    <strong>Address 1:
                    </strong>{{$user->street1}}</p>
                <p>
                    <strong>Address 2:
                    </strong>{{$user->street2}}</p>
                <p>
                    <strong>PostCode:
                    </strong>{{$user->post_code}}</p>
                <p>
                    <strong>City/Town:</strong>
                    {{$user->city}}</p>
                <p>
                    <strong>Country:</strong>
                    {{$user->country?$user->country->name:''}}</p>
            </div>
        </div>

        {{-- user subscription details --}}
        <h2 class="mt-4 mb-3">Subscription Details</h2>
        <div class="adminside-profile-info">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">package</th>
                            <th scope="col">duration</th>
                            <th scope="col">remaing time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>new year</td>
                            <td>1 week</td>
                            <td>2 days</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Eid package</td>
                            <td>2 week</td>
                            <td>6 days</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>independent package</td>
                            <td>10 days</td>
                            <td>2 days</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>
<!-- /.container-fluid -->

@endsection
