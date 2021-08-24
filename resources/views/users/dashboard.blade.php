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
            {{round(Auth::user()->balance,2)}}
        </div>
    </div>
    <div class="dashboard-card new-orders">
        <a href="#" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2>NEW ORDERS</h2>
            <p>9,30,2020</p>
        </div>
        <div class="dashboard-card-stat">
            6575
        </div>
    </div>
    <div class="dashboard-card total-earnings bg-dark">
        <a href="#" class="text-white dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2 class="text-white">TOTAL EARNINGS</h2>
            <p class="text-white">all income</p>
        </div>
        <div class="dashboard-card-stat">
            £ 1234
        </div>
    </div>
</div>
<div class="dashboard-second-line d-flex justify-content-between flex-wrap">
    <div class="cards-section d-flex flex-column align-content-between">
        <div
            class="dashboard-card upload-banner d-flex align-items-center justify-content-center">
            <a
                href="{{route('user.transactions')}}"
                class="dashboard-card-link">
                Transactions
            </a>
        </div>
        <div
            class="dashboard-card add-promotions d-flex align-items-center justify-content-center">
            <a
                href="#"
                class="dashboard-card-link"
                data-toggle="modal"
                data-target="#addPromotionsModal">
                ADD PROMOTION
            </a>
        </div>
    </div>
    <div class="chart-section">
        <div class="card chart-card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Online Store Visitors</h3>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">820</span>
                        <span>Visitors Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i>
                            12.5%
                        </span>
                        <span class="text-muted">Since last week</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i>
                        This Week
                    </span>
                    <span>
                        <i class="fas fa-square text-gray"></i>
                        Last Week
                    </span>
                </div>
            </div>
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
