
<div class="carousel-inner carousel slide" id="mainSlider" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
    </ol>

        <div class="carousel-item active main-slider"
            style="">
            <div class="slider-content d-flex">
                   <div class="slider-caption">
                    <p>{!!$slider->slider_content!!}</p>
                    <a class="banner-btn" href="{{$slider->link}}">{{$slider->button_text}}</a>
                </div>
                <div class="slider-img">
                 <img src="{{$slider->image}}" alt="">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
</div>
