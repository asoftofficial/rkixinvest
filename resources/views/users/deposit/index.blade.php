@extends('users.layouts.default')
@section('page-title')
    Deposits
@endsection
@section('header-right')
    <a href="{{ route('user.deposit.methods') }}" class="btn btn-primary btn-blue header-right-btn">@lang('Deposit')</a>
@endsection
@push('script')

@endpush
@section('content')
    <div class = "container-fluid" >
        {{-- Page Section Title Area    --}}
        <section class = "page-section-title-area">
            <div>
                <h2>Deposits</h2>
                <p>All deposits information</p>
            </div>
        </section>{{-- End Page Section Title Area    --}}
        <section class = "collections" >
            <div class="table-responsive">
                <table class="table custom-table table-responsive-md">
                    <thead class="thead-light">
                    <tr>
                        <th>@lang('Trx')</th>
                        <th>@lang('Gateway')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Charge')</th>
                        <th>@lang('Rate')</th>
                        <th>@lang('Addable')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Time')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($deposits as $k=>$data)
                        <tr>
                            <td data-label="#@lang('Trx')">{{$data->trx}}</td>
                            <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                            <td data-label="@lang('Amount')">
                                <strong>{{showAmount($data->amount)}} USD</strong>
                            </td>
                            <td data-label="@lang('Charge')" class="text-danger">
                                {{showAmount($data->charge)}} USD
                            </td>
                            <td data-label="@lang('Rate')">
                                {{showAmount($data->rate)}} {{__($data->currency)}}
                            </td>
                            <td data-label="@lang('Receivable')" class="text--base">
                                <strong>{{showAmount($data->final_amount)}} {{__($data->currency)}}</strong>
                            </td>
                            <td data-label="@lang('Status')">
                                @if($data->status == 2)
                                    <span class="badge badge--warning">@lang('Pending')</span>
                                @elseif($data->status == 1)
                                    <span class="badge badge--success">@lang('Completed')</span>
                                    <button class="btn-info btn-rounded  badge approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></button>
                                @elseif($data->status == 3)
                                    <span class="badge badge--danger">@lang('Rejected')</span>
                                    <button class="btn-info btn-rounded badge approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></button>
                                @endif

                            </td>
                            <td data-label="@lang('Time')">
                                {{showDateTime($data->created_at)}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $deposits->render('admin.custom-paginator') !!}
            </div>
        </section>
    </div>
    <!-- /.container-fluid -->
@endsection
