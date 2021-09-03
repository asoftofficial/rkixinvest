@extends('users.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{ route('user.deposit') }}" class="btn btn-primary btn-blue header-right-btn">@lang('Deposit History')</a>
@endsection
@push('style')
    <style>
        .list-group-item{
            background: transparent;
        }
    </style>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.withdraw').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var withdrawLimit = `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  USD`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge = `@lang('Charge'): ${fixCharge} USD ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center gy-4">

            @foreach($methods as $data)

                <div class="col-lg-4 col-md-6">
                    <div class="custom--card">
                        <h5 class="card-header text-center">{{__($data->name)}}</h5>
                        <div class="card-body card-body-withdraw">
                            <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image,imagePath()['withdraw']['method']['size'])}}" class="card-img-top" alt="{{__($data->name)}}" class="w-100">
                            <ul class="list-group text-center">
                                <li class="list-group-item">@lang('Limit')
                                    : {{showAmount($data->min_limit)}}
                                    - {{showAmount($data->max_limit)}} USD</li>

                                <li class="list-group-item"> @lang('Charge')
                                    - {{showAmount($data->fixed_charge)}} USD
                                    + {{showAmount($data->percent_charge)}}%
                                </li>
                                <li class="list-group-item">@lang('Processing Time')
                                    - {{$data->delay}}</li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)"  data-id="{{$data->id}}"
                               data-resource="{{$data}}"
                               data-min_amount="{{showAmount($data->min_limit)}}"
                               data-max_amount="{{showAmount($data->max_limit)}}"
                               data-fix_charge="{{showAmount($data->fixed_charge)}}"
                               data-percent_charge="{{showAmount($data->percent_charge)}}"
                               data-base_symbol="USD"
                               class="btn btn-block text-white btn-blue w-100 withdraw" data-toggle="modal" data-target="#withdrawModal">
                                @lang('Deposit')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-610" role="document">
            <div class="modal-content issue-padd">
                <div class="modal-header pb-0">
                    <h5 class="modal-title" id="exampleModalLabel mt-0">Withdraw Amount</h5>
                </div>
                <form action="{{route('user.deposit.money')}}"
                      enctype="multipart/form-data"
                      method="post">
                    <div class="modal-body  pt-0">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control">
                        </div>

                        <p class="text--base withdrawLimit"></p>
                        <p class="text--base withdrawCharge"></p>

                        <div class="form-group">
                            <label>@lang('Enter Amount')<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control bg-light border-0 round-10" name="amount" placeholder="@lang('Amount')" required  value="{{old('amount')}}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                <span class="input-group-text bg--base">USD</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button
                                type="button"
                                class="btn btn-outline-blue px-4 mr-1 px-5"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-blue px-4 px-5">Confirm</button>
                        </div>
                </form>
            </div>
        </div>
    </div>



@endsection
