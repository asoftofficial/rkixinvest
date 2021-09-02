<div class="top-bar">
    <div class="top-bar-left">
        <ul>
            <li><i class="fas fa-envelope"></i><a href="#"><span>{{$settings->email}}</span></a></li>
            <li><i class="fas fa-phone"></i><a href="#"><span>{{$settings->phone}}</span></a></li>
            <li><i class="fas fa-map-marker-alt"></i><a href="#"><span>{{$settings->address}}</span></a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <a href="{{$sociallinks->pintrest}}" class="social-links top-social-links"><i class="fab fa-pinterest-p"></i></a>
        <a href="{{$sociallinks->linkedin}}" class="social-links top-social-links"><i class="fab fa-linkedin-in"></i></a>
        <a href="{{$sociallinks->twitter}}" class="social-links top-social-links"><i class="fab fa-twitter"></i></a>
        <a href="{{$sociallinks->facebook}}" class="social-links top-social-links"><i class="fab fa-facebook-f"></i></a>
    </div>
</div>
