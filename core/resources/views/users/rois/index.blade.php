@extends('users.layouts.default')
@section('page-title')
Dashboard
@endsection
@section('page-subtitle')
Welcome back,
@endsection
@section('header-right')
    <a href="{{ route('user.investment') }}" class="btn btn-primary btn-blue header-right-btn">@lang('back')</a>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area">
            <div>
                <h2>RECENT INVESTMENTS</h2>
                <p>Latest investments details</p>
            </div>
            <div class="section-title-right"></div>
        </section>
        {{--    End Page Section Title Area    --}}
                            <section class="customers">
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Investment ID</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                                {{-- <th scope="col">Date</th> --}}
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($investment->rois as $roi)
                                                    <tr>
                                                        <td>{{$roi->investment_id}}</td>
                                                        <td>{{$roi->amount}}</td>
                                                        <td>{{$roi = $roi->status==1 ? 'Pending' : 'Received'}}</td>
                                                        {{-- <td>{{dd($roi->date)}}</td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    {{--  Add Issues Model  --}}
                    {{-- @include('admin.issues.modals.create') --}}
                    {{--  End Add Issues Model  --}}
                    {{-- @include('admin.banners.modals.create') --}}
                    {{-- @include('admin.promotions.modals.create') --}}
                    {{-- @endsection --}}
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection
