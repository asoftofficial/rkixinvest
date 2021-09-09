@extends('front.layouts.default')
@section('content')
    <!-- Slider start -->
    @include('front.partials.slider')
    <!-- Slider end -->

    @push('style')
        <style>
            span.step-icon {
            align-self: center;
            position: relative;
            top: 30px;
        }

       @media screen and (max-width: 768px) {
          span.step-icon {
            top: 10px;
            }
            .step-inner p {
            font-size: 20px;
            }
        }
            .testimonials-carousal {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
        </style>
    @endpush
    <!-- About Section Start-->
    <section class="about">
        <div class="container">
            <div class="about-container">
                <img class="shap triangle" src="{{ asset('assets/frontend/bg-shapes/triangle.png') }}" alt="">
                <img class="shap dots" src="{{ asset('assets/frontend/bg-shapes/dots.png') }}" alt="">
                <div class="about-image">
                    <img src="{{$frontdata->section_image}}" alt="About RkixInvest">
                </div>
                <div class="about-text">
                    <h3>{{$frontdata->section_title}}</h3>
                    <h2>{{$frontdata->section_heading}}</h2>
                    <p>{{$frontdata->section_description}}</p>
                    <a href="{{$frontdata->link}}" class="btn blue-iconic-btn">{{$frontdata->button_text}}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- How to Section Start-->
    <section class="steps-section bg-light">
        <div class="container text-center">
            <h2>{{$frontdata->step_title}}</h2>
            <p>{{$frontdata->step_content}}</p>
            <div class="steps">
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">1</div>
                        <span class="step-icon"><img src="{{$frontdata->icon1}}" alt=""></span>
                        <p>{{$frontdata->step1}}</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">2</div>
                        <span class="step-icon"><img src="{{$frontdata->icon1}}" alt=""></span>
                        <p>{{$frontdata->step2}}</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">3</div>
                        <span class="step-icon"><img src="{{$frontdata->icon1}}" alt=""></span>
                        <p>{{$frontdata->step3}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How to Section End-->

    <!-- transactions section start-->
    <section class="transactions">
        <div class="container">
            <div class="transactions-inner">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit"
                            role="tab" aria-controls="nav-deposit" aria-selected="true">Deposits</a>
                        <a class="nav-item nav-link" id="nav-withdrawal-tab" data-toggle="tab" href="#nav-withdrawal"
                            role="tab" aria-controls="nav-withdrawal" aria-selected="false">Withdrawals</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-deposit" role="tabpanel"
                        aria-labelledby="nav-deposit-tab">
                        <h2>Latest Deposits</h2>
                        <div class="table table-responsive bg-light round-20">
                            <table class="table table-responsive">
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Gateway</th>
                                </tr>
                                <tr>
                                    <td>John Smith</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('assets/frontend/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-withdrawal" role="tabpanel" aria-labelledby="nav-withdrawal-tab">
                        <h2>Latest Withdrawals</h2>
                        <div class="table table-responsive  bg-light round-20">
                            <table class="table table-responsive">
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Gateway</th>
                                </tr>
                                @forelse($withdrawals as $item)
                                    <tr>
                                        <td>{{$item->user->username}}</td>
                                        <td>{{$item->amount}}$</td>
                                        <td>{{$item->method->name}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- transactions section end-->

    <!-- testimonials section start-->
    <section class="testimonials bg-light">
        <div class="container text-center">
            <h3 class="text-blue opacity-1">Testimonials</h3>
            <h2 class="text-blue">What Client Say</h2>
            <div class="testimonials-carousal">
                @foreach ($testimonials as $item)
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            {{$item->content}}
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{$item->image}}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>{{$item->username}}</h4>
                                    <h5>{{$item->designation}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonials section end-->
@endsection
