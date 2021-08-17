<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>RkixInvest</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backend/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Carousal Style --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Custom styles for this template -->
    <style>
        :root{
            --blue: #0172FF;
            --black: #000000;
            --gray: #474747;
            --light-gray: #EEEEEE;
            --white: #FFFFFF;
    }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        h1,h2,h3,h4,h5,h6,p,li,a{
            font-family: 'Rubik', sans-serif !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/front.css') }}">

  </head>

  <body>
      <header>
          <div class="top-bar">
              <div class="top-bar-left">
                  <ul>
                      <li><i class="fas fa-envelope"></i><a href="#"><span>info@gmail.com</span></a></li>
                      <li><i class="fas fa-phone"></i><a href="#"><span>425-302-7869</span></a></li>
                      <li><i class="fas fa-map-marker-alt"></i><a href="#"><span>462 Academy Ave, Goose, SC 29445</span></a></li>
                  </ul>
              </div>
              <div class="top-bar-right">
                  <a href="#" class="social-links top-social-links"><i class="fab fa-pinterest-p"></i></a>
                  <a href="#" class="social-links top-social-links"><i class="fab fa-linkedin-in"></i></a>
                  <a href="#" class="social-links top-social-links"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="social-links top-social-links"><i class="fab fa-facebook-f"></i></a>
              </div>
          </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-light px-3 main-nav">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
          {{-- <div class="banner">
              <div class="container d-flex justify-content-center align-items-center">
                <div class="banner-desc">
                    <h2>Recording your business finance <span>Effortlessly</span></h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <a class="banner-btn" href="#">Start Now</a>
                  </div>
                  <div class="banner-img">
                      <img src="{{ asset('frontend/assets/images/banner-img.png') }}" alt="">
                  </div>
              </div>
          </div> --}}

          <!-- Slider Wrapper -->
          <div class="slider-area">
              <!-- Slider Wrapper -->
                <div class="css-slider-wrapper">
                    <input type="radio" name="slider" class="slide-radio1" checked id="slider_1">
                    <input type="radio" name="slider" class="slide-radio2" id="slider_2">
                    <input type="radio" name="slider" class="slide-radio3" id="slider_3">
                    <input type="radio" name="slider" class="slide-radio4" id="slider_4">

                    <!-- Slider Pagination -->
                    <div class="slider-pagination">
                    <label for="slider_1" class="page1"></label>
                    <label for="slider_2" class="page2"></label>
                    <label for="slider_3" class="page3"></label>
                    <label for="slider_4" class="page4"></label>
                    </div>

                    <!-- Slider #1 -->
                    <div class="slider slide-1">
                    <img src="images/model-1.png" alt="">
                    <div class="slider-content">
                        <h2>Recording your business finance <span>Effortlessly</span></h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <a class="banner-btn" href="#">Start Now</a>
                    </div>
                    <div class="number-pagination">
                        <span>1</span>
                    </div>
                    </div>

                    <!-- Slider #2 -->
                    <div class="slider slide-2">
                    <img src="/frontend/assets/images/banner-img.png" alt="">
                    <div class="slider-content">
                        <h2>Recording your business finance <span>Effortlessly</span></h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <a class="banner-btn" href="#">Start Now</a>
                    </div>
                    <div class="number-pagination">
                        <span>2</span>
                    </div>
                    </div>

                    <!-- Slider #3 -->
                    <div class="slider slide-3">
                    <img src="images/model-3.png" alt="">
                    <div class="slider-content">
                        <h2>Recording your business finance <span>Effortlessly</span></h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        <a class="banner-btn" href="#">Start Now</a>
                    </div>
                    <div class="number-pagination">
                        <span>3</span>
                    </div>
                    </div>

                    <!-- Slider #4 -->
                    <div class="slider slide-4">
                    <img src="images/model-4.png" alt="">
                    <div class="slider-content">
                        <h4>New Product</h4>
                        <h2>Denim Longline T-Shirt Dress With Split</h2>
                        <button type="button" class="buy-now-btn" name="button">$130</button>
                    </div>
                    <div class="number-pagination">
                        <span>4</span>
                    </div>
                    </div>
                </div>
            </div>
      </header>
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
                        <h3>About Us</h3>
                        <h2>Boost Your Business.</h2>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,</p>
                        <a href="#" class="btn blue-iconic-btn">More Details</a>
                    </div>
                </div>
            </div>
        </section>
      <!-- About Section End-->

      <!-- How to Section Start-->
        <section class="steps-section bg-light">
            <div class="container text-center">
                <h2>How to invest</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi illo, perspiciatis fugit blanditiis fuga quas quo laboriosam alias sequi rem, id tempora, error rerum. Fugiat beatae sint repudiandae ab blanditiis?</p>
            <div class="steps">
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">1</div>
                        <span class="step-icon"></span>
                        <p>Deposit Amount</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">2</div>
                        <span class="step-icon"></span>
                        <p>Buy Package</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-inner">
                        <div class="step-num">3</div>
                        <span class="step-icon"></span>
                        <p>Earn Profit</p>
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
                          <a class="nav-item nav-link active" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="true">Deposits</a>
                          <a class="nav-item nav-link" id="nav-withdrawal-tab" data-toggle="tab" href="#nav-withdrawal" role="tab" aria-controls="nav-withdrawal" aria-selected="false">Withdrawals</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active bg-light round-20" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
                            <div class="table table-responsive">
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
                                        <td><img src="{{ asset('frontend/assets/images/master-card-logo.png') }}" alt=""></td>
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
                        <div class="tab-pane fade bg-light round-20" id="nav-withdrawal" role="tabpanel" aria-labelledby="nav-withdrawal-tab">
                            <div class="table table-responsive">
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
                                        <td><img src="{{ asset('frontend/assets/images/master-card-logo.png') }}" alt=""></td>
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
                <div class="testimonials-inner">
                    <div class="testimonial">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words,
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
            </div>
        </section>
      <!-- testimonials section end-->




      <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-col">
                <h2>LOGO HERE</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam iusto similique. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="footer-col">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">How to Invest</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h2>Support</h2>
                <ul>
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h2>Social Links</h2>
                <ul class="footer-social-links">
                    <li><a class="social-link footer-social-link" href=""><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a class="social-link footer-social-link" href=""><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a class="social-link footer-social-link" href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a class="social-link footer-social-link" href=""><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center">
            Copyright &copy; 2021 All Rights Reserved <a href="#">RkixInvest</a>
        </div>
      </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src={{ asset('frontend/dashboard/plugins/bootstrap/js/bootstrap.min.js') }}></script>
    <script src={{ asset('frontend/dashboard/plugins/jquery/jquery.min.js') }}></script>
    {{-- Carousal Script --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var TIMEOUT = 6000;

 var interval = setInterval(handleNext, TIMEOUT);

 function handleNext() {

   var $radios = $('input[class*="slide-radio"]');
   var $activeRadio = $('input[class*="slide-radio"]:checked');

   var currentIndex = $activeRadio.index();
   var radiosLength = $radios.length;

   $radios
     .attr('checked', false);

   if (currentIndex >= radiosLength - 1) {

     $radios
       .first()
       .attr('checked', true);

   } else {

     $activeRadio
       .next('input[class*="slide-radio"]')
       .attr('checked', true);

   }

 }
//  Init Testimonial Carousal
// $(document).ready(function(){
//   $(".testimonials-carousal").owlCarousel({
//     loop:true,
//     margin:10,
//     responsiveClass:true,
//     responsive:{
//         0:{
//             items:1,
//             nav:true
//         },
//         600:{
//             items:3,
//             nav:false
//         },
//         1000:{
//             items:3,
//             nav:true,
//             loop:false
//         }
//     }
//   });
// });
$(document).ready(function(){
  $('.testimonials-carousal').slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });
});
    </script>
  </body>
</html>
