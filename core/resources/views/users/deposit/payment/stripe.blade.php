@extends('users.layouts.default')
@section('page-title')
    Deposits
@endsection

@section('css')
    <script src="https://js.stripe.com/v3/"></script>
@stop
@section('content')

    <style>
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>


    <div class="faq-section shadow-bg">
        <div class="container">


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-deposit">
                        <div class="card-header custom-header text-center">
                            <h4 class="card-title">@lang('Stripe Payment')</h4>
                        </div>
                        <div class="card-body text-center">

                            <div class="row justify-content-center">
                                <div class="col-md-4">

                                    <div class="card ">
                                        <div class="card-body card-body-deposit">
                                            <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $deposit->method->image,imagePath()['withdraw']['method']['size'])}}" class="card-img-top" alt="{{__($deposit->method->name)}}" class="w-100">

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group font-weight-bold">
                                        <li class="list-group-item">@lang('Amount') : {{showAmount($deposit->amount,2)}} {{$deposit->currency}}</li>
                                        <li class="list-group-item">@lang('Charge') : {{showAmount($deposit->charge,2)}} {{$deposit->currency}}</li>
                                        <li class="list-group-item">@lang('Rate') : {{showAmount($deposit->rate,2)}} {{$deposit->currency}}</li>
                                        <li class="list-group-item">@lang('Payable Amount') : {{showAmount($deposit->final_amount,2)}} {{$deposit->method_currency}}</li>

                                        <li class="list-group-item">
                                            <form action="{{$data->url}}" method="{{$data->method}}">
                                                <script
                                                        src="{{$data->src}}"
                                                        class="stripe-button"
                                                        @foreach($data->val as $key=> $value)
                                                        data-{{$key}}="{{$value}}"
                                                        @endforeach
                                                >
                                                </script>
                                            </form>
                                        </li>
                                    </ul>



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection

@section('js')

@stop


