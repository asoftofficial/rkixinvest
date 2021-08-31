@extends('admin.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <button class="btn btn-primary btn-blue header-right-btn">Button</button>
@endsection
@push('style')

@endpush
@push('script')

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method'))
                <div class="col-xl-4 col-sm-6 mb-30">
                    <div class="widget-two box--shadow2 b-radius--5 bg--success">
                        <div class="widget-two__content">
                            <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',1)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Approved Withdrawals')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-xl-4 col-sm-6 mb-30">
                    <div class="widget-two box--shadow2 b-radius--5 bg--6">
                        <div class="widget-two__content">
                            <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',2)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Pending Withdrawals')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-xl-4 col-sm-6 mb-30">
                    <div class="widget-two box--shadow2 b-radius--5 bg--pink">
                        <div class="widget-two__content">
                            <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',3)->sum('amount') }}</h2>
                            <p class="text-white">@lang('Rejected Withdrawals')</p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
            @endif
            <div class="col-lg-12">
                <section class = "page-section-title-area" > <div>
                        <h2>{{$pageTitle}}</h2>
                        <p>Withdrawals information</p>
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
                                @forelse($withdrawals as $withdraw)
                                    @php
                                        $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                                    @endphp
                                    <tr>
                                        <td data-label="@lang('Gateway | Trx')">
                                            <span class="font-weight-bold"><a href="{{ route('admin.withdraw.method',[$withdraw->method->id,'all']) }}"> {{ __(@$withdraw->method->name) }}</a></span>
                                            <br>
                                            <small>{{ $withdraw->trx }}</small>
                                        </td>
                                        <td data-label="@lang('Initiated')">
                                            {{ showDateTime($withdraw->created_at) }} <br>  {{ diffForHumans($withdraw->created_at) }}
                                        </td>

                                        <td data-label="@lang('User')">
                                            <span class="font-weight-bold">{{ $withdraw->user->first_name.' '.$withdraw->user->last_name }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ route('admin.userprofile.index', $withdraw->user_id) }}"><span>@</span>{{ $withdraw->user->username }}</a> </span>
                                        </td>


                                        <td data-label="@lang('Amount')">
                                            USD{{ showAmount($withdraw->amount ) }} - <span class="text-danger" data-toggle="tooltip" data-original-title="@lang('charge')">{{ showAmount($withdraw->charge)}} </span>
                                            <br>
                                            <strong data-toggle="tooltip" data-original-title="@lang('Amount after charge')">
                                                {{ showAmount($withdraw->amount-$withdraw->charge) }} USD
                                            </strong>

                                        </td>

                                        <td data-label="@lang('Conversion')">
                                            1 USD =  {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}
                                            <br>
                                            <strong>{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</strong>
                                        </td>



                                        <td data-label="@lang('Status')">
                                            @if($withdraw->status == 2)
                                                <span class="text-small badge font-weight-normal badge--warning">@lang('Pending')</span>
                                            @elseif($withdraw->status == 1)
                                                <span class="text-small badge font-weight-normal badge--success">@lang('Approved')</span>
                                                <br>{{ diffForHumans($withdraw->updated_at) }}
                                            @elseif($withdraw->status == 3)
                                                <span class="text-small badge font-weight-normal badge--danger">@lang('Rejected')</span>
                                                <br>{{ diffForHumans($withdraw->updated_at) }}
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="icon-btn ml-1 " data-toggle="tooltip" data-original-title="@lang('Detail')">
                                                <i class="fas fa-desktop"></i>
                                            </a>
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
                    {!! $withdrawals->render('admin.custom-paginator') !!}
                </div><!-- card end -->

            </div>
    </div>
    <!-- /.container-fluid -->
@endsection
