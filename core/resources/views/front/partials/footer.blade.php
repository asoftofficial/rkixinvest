<footer class="main-footer">
        <div class="footer-top">
            <div class="footer-col">
                @if(empty($settings->llogo))
                    <img src="{{route('placeholder.image','200x80')}}"  alt="logo" />
                @else
                    <img src="{{$settings->llogo}}" class="" alt="logo">
                @endif
                <p>{{$settings->description}}</p>
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
                    <li><a class="social-link footer-social-link" href="{{$sociallinks->pintrest}}"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a class="social-link footer-social-link" href="{{$sociallinks->linkedin}}"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a class="social-link footer-social-link" href="{{$sociallinks->twitter}}"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="social-link footer-social-link" href="{{$sociallinks->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center">
             <a href="#">{{$settings->footer}}</a>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('assets/plugins/slim/slim.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- Carousal Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        // $('.carousel').carousel()
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
        $(document).ready(function () {
            $('.testimonials-carousal').slick({
                dots: false,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 3,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
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
        $('.top-bar-left ul li').click(function(){
            $(this).children().children().slideToggle()
        })
    </script>
    @stack('script')
</body>

</html>
