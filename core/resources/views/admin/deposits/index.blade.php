@extends('admin.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-blue header-right-btn">Dashboard</a>
@endsection
@push('style')
    <style>
        .widget-two {
            padding: 10px 10px 1px 10px;
        }
    </style>
@endpush
@push('script')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if(request()->routeIs('admin.deposit.log') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposit') || request()->routeIs('admin.users.deposit.method'))
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="widget-two b-radius-5 bg-success">
                        <div class="widget-two__content">
                            <h2 class="text-white">USD {{ $deposits->where('status',1)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Approved Deposits')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="widget-two b-radius-5 bg-warning">
                        <div class="widget-two__content">
                            <h2 class="text-white">USD {{ $deposits->where('status',2)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Pending Deposits')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="widget-two b-radius-5 bg-danger">
                        <div class="widget-two__content">
                            <h2 class="text-white">USD {{ $deposits->where('status',3)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Rejected Deposits')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
            @endif
            <div class="col-lg-12">
                <section class = "page-section-title-area" > <div>
                        <h2>{{$pageTitle}}</h2>
                        <p>Deposits information</p>
                    </div>
                </section>
                <div class="card b-radius--10 ">
                    <div class="card-body p-0">

                        <div class="table-responsive-sm table-responsive">
                            <table class="table custom-table">
                                <thead>
                                <tr>
                                    <th>@lang('Gateway | Trx')</th>
                                    <th>@lang('Initiated')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Conversion')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deposits as $deposit)
                                    @php
                                        $details = ($deposit->information != null) ? json_encode($deposit->information) : null;
                                    @endphp
                                    <tr>
                                        <td data-label="@lang('Gateway | Trx')">
                                            <span class="font-weight-bold"><a href="{{ route('admin.deposit.method',[$deposit->method->id,'all']) }}"> {{ __(@$deposit->method->name) }}</a></span>
                                            <br>
                                            <small>{{ $deposit->trx }}</small>
                                        </td>
                                        <td data-label="@lang('Initiated')">
                                            {{ showDateTime($deposit->created_at) }} <br>  {{ diffForHumans($deposit->created_at) }}
                                        </td>

                                        <td data-label="@lang('User')">
                                            <span class="font-weight-bold">{{ $deposit->user->first_name.' '.$deposit->user->last_name }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ route('admin.userprofile.show', $deposit->user_id) }}"><span>@</span>{{ $deposit->user->username }}</a> </span>
                                        </td>


                                        <td data-label="@lang('Amount')">
                                            USD{{ showAmount($deposit->amount ) }} - <span class="text-danger" data-toggle="tooltip" data-original-title="@lang('charge')">{{ showAmount($deposit->charge)}} </span>
                                            <br>
                                            <strong data-toggle="tooltip" data-original-title="@lang('Amount after charge')">
                                                {{ showAmount($deposit->amount-$deposit->charge) }} USD
                                            </strong>

                                        </td>

                                        <td data-label="@lang('Conversion')">
                                            1 USD =  {{ showAmount($deposit->rate) }} {{ __($deposit->currency) }}
                                            <br>
                                            <strong>{{ showAmount($deposit->final_amount) }} {{ __($deposit->currency) }}</strong>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if($deposit->status == 2)
                                                <span class="text-small badge font-weight-normal badge--warning">@lang('Pending')</span>
                                            @elseif($deposit->status == 1)
                                                <span class="text-small badge font-weight-normal badge--success">@lang('Approved')</span>
                                                <br>{{ diffForHumans($deposit->updated_at) }}
                                            @elseif($deposit->status == 3)
                                                <span class="text-small badge font-weight-normal badge--danger">@lang('Rejected')</span>
                                                <br>{{ diffForHumans($deposit->updated_at) }}
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">

                                            @if($deposit->status==2)
                                                <a href="#" class="text-success ml-1 approve" data-id="{{$deposit->id}}" data-tooltip="tooltip" title="@lang('Approve')" data-toggle="modal" data-target="#approveModal">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @else
                                                <a href="#" class="text-danger ml-1 reject" data-id="{{$deposit->id}}" data-tooltip="tooltip" title="@lang('Reject')" data-toggle="modal" data-target="#rejectModal">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table><!-- table end -->
                        </div>
                    </div>
                    {!! $deposits->render('admin.custom-paginator') !!}
                </div><!-- card end -->

            </div>
    </div>
    <!-- /.container-fluid -->
        @include('admin.deposits.modals.approve')
        @include('admin.deposits.modals.reject')
@endsection
