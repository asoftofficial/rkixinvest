@extends('users.layouts.default')
@section('page-title')
Dashboard
@endsection
@section('page-subtitle')
Welcome back,
@endsection
@push('style')
<link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" > @endpush
@push('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$('.custom-file-input').change(function (e) {
    var filename = $(this)
        .val()
        .split('\\')
        .pop();
    var lastIndex = filename.lastIndexOf("\\");
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = filename
});
$(function () {
    $('.datepicker').datepicker({dateFormat: 'yy-m-d'})
    $('select.ui-select').selectmenu();
});
</script>
@endpush
@section('content')
<div class = "container-fluid" > <div class="dashboard-first-line d-flex justify-content-between flex-wrap">
    <div
        class="dashboard-card upload-issues d-flex align-items-center justify-content-center">
        <a
            href="#"
            class="dashboard-card-link">
            Add Funds
        </a>
    </div>
    <div class="dashboard-card page-views">
        {{-- <a href="#" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a> --}}
        <div class="dashboard-card-header">
            <h2>BALANCE</h2>
            <p>Total Balance</p>
        </div>
        <div class="dashboard-card-stat">
            USD {{round(Auth::user()->balance,2)}}
        </div>
    </div>
    <div class="dashboard-card new-orders">
        <a href="#" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2>Investment</h2>
            <p>Total Investments</p>
        </div>
        <div class="dashboard-card-stat">
            USD {{auth()->user()->investments()->sum('amount')}}
        </div>
    </div>
    <div class="dashboard-card total-earnings bg-dark">
        <a href="#" class="text-white dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2 class="text-white">TOTAL ROIs</h2>
            <p class="text-white">All ROIs</p>
        </div>
        <div class="dashboard-card-stat">
             {{round(auth()->user()->rois()->count(),2)}}
        </div>
    </div>
</div>
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
                                                <th scope="col">Package</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total ROIs</th>
                                                <th scope="col">Recieved ROIs</th>
                                                <th scope="col">Progress</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($investments as $inv)
                                                    <tr>
                                                        <td>{{$inv->id}}</td>
                                                        <td>{{$inv->package->title}}</td>
                                                        <td>{{$inv->amount}}</td>
                                                        <td>{{$status = $inv->status==1 ? 'Active' : 'Expired'}}</td>
                                                        <td>{{$inv->created_at}}</td>
                                                        <td>{{$inv->rois->count()}}</td>
                                                        <td>{{$inv->rois->where('status',0)->count()}}</td>
                                                        <td>
                                                        @php
                                                            $progress = get_percentage($inv->rois->count(), $inv->rois->where('status',0)->count());
                                                        @endphp
                                                            <div class="progress progress-sm active">
                                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                                                                    <span class="sr-only">{{$progress}}% Complete</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><a href="{{route('user.rois',$inv->id)}}" class="btn btn-primary">Details</a></td>
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
                    @endsection
                </div>
            </div>
        </div>
    </div>
</div>
