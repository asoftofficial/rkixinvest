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
    // Chart start
    $(function () {
        ajaxGetChartData()
        $('.to').change(function(){
            var to = $('.to').val()
            var from = $('.from').val()
            ajaxGetChartData(to,from)
        });

    })

    function ajaxGetChartData(to=null,from=null){
        $.ajax({
            type:'GET',
            url:"{{route('ajaxChart')}}",
            'data': {
                _token: "{{ csrf_token() }}",
                to: to,
                from: from
            },
            success:function(data) {
                countChart(data)
            }
        });
    }
    function countChart(data){
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $visitorsChart = $('#investment-chart')
        // eslint-disable-next-line no-unused-vars
        var chartData ;
        var visitorsChart = new Chart($visitorsChart, {
            data: {
                labels: data.days,
                datasets: [{
                    type: 'line',
                    data: data.count_data,
                    backgroundColor: 'transparent',
                    borderColor: '#000',
                    pointBorderColor: '#000000',
                    pointBackgroundColor: '#000000',
                    fill: false
                    // pointHoverBackgroundColor: '#007bff',
                    // pointHoverBorderColor    : '#007bff'
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: data.max
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    }
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
            <p class="text-dark">total deposits</p>
        </div>
        <div class="dashboard-card-stat">
           {{$deposit_amount}}
        </div>
    </div>
    <div class="dashboard-card new-orders">
        <a href="" class=" dashboard-card-dropdown">
            <i class="fas fa-ellipsis-h"></i>
        </a>
        <div class="dashboard-card-header">
            <h2>Total Withdraw Amount</h2>
            <p class="text-dark">total withdrawals</p>
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
                <div class="chart-header">
                    <h3 class="card-title">Investments Summary</h3>

                    <div class="chart-date-area">
                        <div class="chart-date-input-area">
                            <div class="d-flex align-items-center chart-input">
                                <label class="m-0">From</label>
                                <div class="drop2-icon">
                                    <input autocomplete="off" type="text" class="form-control datepicker border-0 from"  name="from">
                                </div>
                            </div>
                        </div>
                        <div class="chart-date-input-area">
                            <div class="d-flex align-items-center chart-input">
                                <label class="m-0">To</label>
                                <div class="drop2-icon">
                                    <input autocomplete="off" type="text" class="form-control datepicker border-0 to"  name="to">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- /.d-flex -->
                <div class="position-relative mb-4">
                    <canvas id="investment-chart" height="200"></canvas>
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
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="{{route('admin.withdraw.log')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$completed_withd}}</h3>

                            <p>Approved withdrawals</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.withdraw.approved')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.withdraw.pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.withdraw.rejected')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <h3>{{$total_deposits}}</h3>

                            <p>Total Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-university"></i>
                        </div>
                        <a href="{{route('admin.deposit.log')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$completed_deposits}}</sup></h3>

                            <p>Complete Deposits</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.deposit.approved')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$pending_deposits}}</h3>

                            <p>Pending Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.deposit.pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$canceled_deposits}}</h3>

                            <p>Rejected Deposit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.deposit.rejected')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('admin.userprofile.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$active_users}}</h3>

                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.show.active.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$investors}}</h3>

                            <p>Total Investors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('admin.show.total.investors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$active_investors}}</h3>

                            <p>Active Investors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.show.active.investors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <h2>RECENT Investments</h2>
                <p>Latest Investments information</p>
            </div>
            <div class="section-title-right"></div>
        </section>
        {{--    End Page Section Title Area    --}}

        <section class="customers">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#Id  </th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">ROIs </th>
                            <th scope="col">Remaining ROIs </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($active_investments as $item)
                            <tr role="row" class="odd">
                                <td class="dtr-control sorting_1" tabindex="0">{{$item->id}}</td>
                                <td>{{$item->amount}}</td>
                                @if($item->status == 1)
                                <td>Active</td>
                                @else
                                <td>Expired</td>
                                @endif
                                 <td>{{$item->rois->count()}} | {{$item->rois->sum('amount')}} USD</td>
                                <td>{{$item->rois->where('status',0)->count()}} | {{showAmount($item->rois->where('status',0)->sum('amount'),2)}} USD</td>
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
