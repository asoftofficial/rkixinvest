@extends('admin.layouts.default')
@section('page-title')
Testimonial
@endsection
@push('style')

    <style>

.testimonial2 {
  font-family: "Montserrat", sans-serif;
  color: #8d97ad;
  font-weight: 300;
}

.testimonial2 h1,
.testimonial2 h2,
.testimonial2 h3,
.testimonial2 h4,
.testimonial2 h5,
.testimonial2 h6 {
  color: #3e4555;
}

.testimonial2 h5 {
    line-height: 22px;
    font-size: 18px;
	font-weight: 400;
}

.testimonial2 .font-weight-medium {
  font-weight: 500;
}

.testimonial2 .bg-light {
  background-color: #f4f8fa !important;
}

.testimonial2 .subtitle {
  color: #8d97ad;
  line-height: 24px;
}

.testimonial2 .testi2 .image-thumb {
  background: url(https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/greadint-bg.png) no-repeat top center;
  text-align: center;
  padding: 10% 0;
}

.testimonial2 .testi2 .image-thumb img {
  width: 400px;
}

.testimonial2 .testi2 .owl-dots {
  display: inline-block;
  position: relative;
  top: -100px;
}

.testimonial2 .testi2 .owl-dots .owl-dot {
  border-radius: 100%;
  width: 70px;
  height: 70px;
  background-size: cover;
  margin-right: 10px;
  opacity: 0.4;
  cursor: pointer;
}

.testimonial2 .testi2 .owl-dots .owl-dot span {
  display: none;
}

.testimonial2 .testi2 .owl-dots .owl-dot.active,
.testimonial2 .testi2 .owl-dots .owl-dot:hover {
  opacity: 1;
}

@media (max-width: 767px) {
  .testimonial2 .testi2 .owl-dots {
    top: 0px;
  }
}

.testimonial2 .btn-md {
    padding: 18px 0px;
    width: 60px;
    height: 60px;
    font-size: 20px;
}

.testimonial2 .btn-danger {
    background: #ff4d7e !important;
    border: 1px solid #ff4d7e !important;
}

.position-relative{
    top: -15vh !important;
}
        </style>
@endpush
@push('script')
    <script>
        $('.testi2').owlCarousel({
  loop: true,
  margin: 20,
  nav: false,
  dots: true,
  autoplay: true,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: false
    },
    1170: {
      items: 1
    }
  }
});

        </script>
@endpush
@section('content')
<div class="container-fluid">

<div class="testimonial2">
  <div class="container">
    <div class="heading">
    </div>
    <div class="owl-carousel owl-theme testi2">
      <div class="item">
        <div class="row position-relative">
          <div class="col-lg-6 col-md-6 align-self-center">
            {{-- <button class="btn rounded-circle btn-danger btn-md"><i class="icon-bubble"></i></button> --}}
            <h4 class="my-3">Customer Review</h4>
            <p>
             {{$testimonial->content}}
            </p>
            <h5 class="mt-4">{{$testimonial->username}}</h5>
            <h6 class="subtitle font-weight-normal">{{$testimonial->designation}}</h6>
          </div>
          <div class="col-lg-6 col-md-6 image-thumb d-none d-md-block">
            <img src="{{$testimonial->image}}" alt="wrapkit" class="rounded-circle img-fluid" />
          </div>
        </div>
    </div>
    </div>
  </div>
</div>
</div>
@endsection
