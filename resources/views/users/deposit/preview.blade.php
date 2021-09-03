@extends('users.layouts.default')
@section('page-title')
    {{$pageTitle}}
@endsection
@section('page-subtitle')
    Welcome back,
@endsection
@section('header-right')
    <a href="{{ route('user.withdraw.history') }}" class="btn btn-primary btn-blue header-right-btn">@lang('Withdraw History')</a>
@endsection
@push('style')
    <style>
        .fileinput .thumbnail{
            max-height: 300px;
            width: 100%;
        }
    </style>
@endpush
@push('script')
    <script>

        (function($){

            "use strict";

            $('.withdraw-thumbnail').hide();

            $('.clickBtn').on('click', function() {

                var classNmae = $('.fileinput').attr('class');

                if(classNmae != 'fileinput fileinput-exists'){
                    $('.withdraw-thumbnail').hide();
                }else{

                    $('.fileinput-preview img').css({"width":"100%", "height":"300px", "object-fit":"contain"});

                    $('.withdraw-thumbnail').show();

                }

            });

        })(jQuery);

    </script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-10">
                <div class="card main-card">
                    <h5 class="text-center mt-3">@lang('Current Balance') :
                        <strong>{{ showAmount(auth()->user()->balance)}}  USD</strong></h5>

                    <div class="card-body mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="withdraw-details">
                                    <span class="font-weight-bold">@lang('Request Amount') :</span>
                                    <span class="font-weight-bold pull-right">{{showAmount($deposit->amount)  }} USD</span>
                                </div>
                                <div class="withdraw-details text-danger">
                                    <span class="font-weight-bold">@lang('Withdrawal Charge') :</span>
                                    <span class="font-weight-bold pull-right">{{showAmount($deposit->charge) }} USD</span>
                                </div>
                                <div class="withdraw-details text-info">
                                    <span class="font-weight-bold text--base">@lang('After Charge') :</span>
                                    <span class="font-weight-bold pull-right text--base">{{showAmount($deposit->after_charge) }} USD</span>
                                </div>
                                <div class="withdraw-details">
                                    <span class="font-weight-bold">@lang('Conversion Rate') : <br>1 USD = </span>
                                    <span class="font-weight-bold pull-right">  {{showAmount($deposit->rate)  }} {{__($deposit->currency)}}</span>
                                </div>
                                <div class="withdraw-details text-success">
                                    <span class="font-weight-bold text--base">@lang('You Will Get') :</span>
                                    <span class="font-weight-bold pull-right text--base">{{showAmount($deposit->final_amount) }} {{__($deposit->currency)}}</span>
                                </div>
                                <div class="form-group mt-5">
                                    <label class="font-weight-bold">@lang('Balance Will be') : </label>
                                    <div class="input-group">
                                        <input type="text" value="{{showAmount($deposit->user->balance + ($deposit->after_charge))}}"  class="form--control bg-light border-0 p-1" placeholder="@lang('Enter Amount')" required readonly>
                                        <span class="input-group-text bg--base">USD </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">

                                    <div class="form-group">
                                        <a href="{{ route('user.pay-now') }}" class="btn btn-base w-100 btn-block btn-lg text-white btn-blue mt-4 text-center">@lang('Pay Now')</a>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
