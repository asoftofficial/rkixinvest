@extends('admin.layouts.default')
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
            class="dashboard-card-link"
            data-toggle="modal"
            data-target="#addIssuesModal">
            UPLOAD ISSUES
        </a>
    </div>
    <div class="dashboard-card page-views">
        <a href="#" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2>Total Deposit Amount</h2>
        </div>
        <div class="dashboard-card-stat">
           {{$deposit_amount}}
        </div>
    </div>
    <div class="dashboard-card new-orders">
        <a href="#" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2>Total Withdraw Amount</h2>
            <p></p>
        </div>
        <div class="dashboard-card-stat">
            {{$withdrawal_amount}}
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
            {{$earning}}
        </div>
    </div>
</div>
<div class="dashboard-second-line d-flex justify-content-between flex-wrap">
    <div class="cards-section d-flex flex-column align-content-between">
        <div
            class="dashboard-card upload-banner d-flex align-items-center justify-content-center">
            <a
                href="#"
                class="dashboard-card-link"
                data-toggle="modal"
                data-target="#addUserModal">
                Create User
            </a>
        </div>
        <div
            class="dashboard-card add-promotions d-flex align-items-center justify-content-center">
            <a
                href="#"
                class="dashboard-card-link"
                data-toggle="modal"
                data-target="#addpackageModal">
                Create Package
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

    <div class="card">
        <div class="card-header bg-dark">
            Withdrawals
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$withdrawals}}</h3>

                            <p>Total Withdrawals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$completed_withd}}</h3>

                            <p>Completed withdrawals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$pending_withd}}</h3>

                            <p>Pending Withdrawals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$rejected_withd}}</h3>

                            <p>Rejected Withdrawals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
     <div class="card">
        <div class="card-header bg-dark">
            Deposits
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Total Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Complete Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Pending Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Rejected Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
     <div class="card">
        <div class="card-header bg-dark">
            User & Investors Statistics
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_users}}</h3>

                            <p>Total Users</p>
                        </div>
                       <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$active_users}}</h3>

                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Total Investors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Active Investors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        {{--    Page Section Title Area    --}}
        <section class="page-section-title-area">
            <div>
                <h2>RECENT ORDERS</h2>
                <p>Latest orders and information</p>
            </div>
            <div class="section-title-right"></div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="customers">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Customer ID
                                <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                <th scope="col">First Name
                                    <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                    <th scope="col">Last Name
                                        <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                        <th scope="col">Email
                                            <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                            <th scope="col">Date
                                                <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                                <th scope="col">Plan
                                                    <img src="{{asset('backend/img/icons/bottom-angle.png')}}" class="ml-1"></th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>155FGV</td>
                                                    <td>Johan</td>
                                                    <td>Doe</td>
                                                    <td>example@gmail.com</td>
                                                    <td>20/12/2021</td>
                                                    <td class="text-uppercase">STANDARD</td>
                                                    <td style="min-width: 256px; text-align: right">
                                                        <a href="#" class="btn btn-dark lightblue-bg round-10 px-4 mr-2">See more</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>155FGV</td>
                                                    <td>Johan</td>
                                                    <td>Doe</td>
                                                    <td>example@gmail.com</td>
                                                    <td>20/12/2021</td>
                                                    <td class="text-uppercase">STANDARD</td>
                                                    <td style="min-width: 256px; text-align: right">
                                                        <a href="#" class="btn btn-dark lightblue-bg round-10 px-4 mr-2">See more</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>155FGV</td>
                                                    <td>Johan</td>
                                                    <td>Doe</td>
                                                    <td>example@gmail.com</td>
                                                    <td>20/12/2021</td>
                                                    <td class="text-uppercase">STANDARD</td>
                                                    <td style="min-width: 256px; text-align: right">
                                                        <a href="#" class="btn btn-dark lightblue-bg round-10 px-4 mr-2">See more</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>155FGV</td>
                                                    <td>Johan</td>
                                                    <td>Doe</td>
                                                    <td>example@gmail.com</td>
                                                    <td>20/12/2021</td>
                                                    <td class="text-uppercase">STANDARD</td>
                                                    <td style="min-width: 256px; text-align: right">
                                                        <a href="#" class="btn btn-dark lightblue-bg round-10 px-4 mr-2">See more</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>155FGV</td>
                                                    <td>Johan</td>
                                                    <td>Doe</td>
                                                    <td>example@gmail.com</td>
                                                    <td>20/12/2021</td>
                                                    <td class="text-uppercase">STANDARD</td>
                                                    <td style="min-width: 256px; text-align: right">
                                                        <a href="#" class="btn btn-dark lightblue-bg round-10 px-4 mr-2">See more</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    {{-- create user model --}}
                    @include('admin.users.modals.create')
                    {{-- create package model --}}
                    @include('admin.packages.modals.create')
                    @endsection
                </div>
            </div>
        </div>
    </div>
</div>
