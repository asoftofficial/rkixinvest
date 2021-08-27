@extends('front.layouts.default')
@section('content')
    <!-- Slider start -->
    @include('front.partials.slider')
    <!-- Slider end -->
    <!-- About Section Start-->
    <section class="about">
        <div class="container">
            <div class="about-container">
                <img class="shap triangle" src="{{ asset('frontend/assets/bg-shapes/triangle.png') }}" alt="">
                <img class="shap dots" src="{{ asset('frontend/assets/bg-shapes/dots.png') }}" alt="">
                <div class="about-image">
                    <img src="{{ asset('frontend/assets/images/about.png') }}" alt="About RkixInvest">
                </div>
                <div class="about-text">
                    <h3>{{$aboutus->section_title}}</h3>
                    <h2>{{$aboutus->section_heading}}</h2>
                    <p>{{$aboutus->section_description}}</p>
                    <a href="{{$aboutus->link}}" class="btn blue-iconic-btn">{{$aboutus->button_text}}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- How to Section Start-->
    <section class="steps-section bg-light">
        <div class="container text-center">
            <h2>{{$data->step_title}}</h2>
            <p>{{$data->step_content}}</p>
            <div class="steps">
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">1</div>
                        <span class="step-icon"></span>
                        <p>{{$data->step1}}</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">2</div>
                        <span class="step-icon"></span>
                        <p>{{$data->step2}}</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">3</div>
                        <span class="step-icon"></span>
                        <p>{{$data->step3}}</p>
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
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Anthony</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/visa-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Calor Smith</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>John Jarry</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/master-card-logo.png') }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamie</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/visa-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Clark</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
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
                                <tr>
                                    <td>John Smith</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Anthony</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/visa-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Calor Smith</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>John Jarry</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/master-card-logo.png') }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jamie</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/visa-logo.png') }}" alt=""></td>
                                </tr>
                                <tr>
                                    <td>Clark</td>
                                    <td>23000$</td>
                                    <td><img src="{{ asset('frontend/assets/images/paypal-logo.png') }}" alt=""></td>
                                </tr>
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
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>{{$item->username}}</h2>
                                    <h5>{{$item->designation}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>Lilly Adams</h2>
                                    <h5>Manager</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>Lilly Adams</h2>
                                    <h5>Manager</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>Lilly Adams</h2>
                                    <h5>Manager</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>Lilly Adams</h2>
                                    <h5>Manager</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                            of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                            a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                            Latin words,
                        </p>
                        <div class="testimonial-user">
                            <div class="testimonial-user-img">
                                <img src="{{ asset('frontend/assets/images/lilly.png') }}" alt="">
                            </div>
                            <div class="testimonial-user-info">
                                <h4>Lilly Adams</h2>
                                    <h5>Manager</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
    <!-- testimonials section end-->
@endsection
