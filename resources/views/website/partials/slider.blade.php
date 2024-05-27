<section class="slider-area">
    <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
        @foreach($sliders as $item)
        <!-- single slider item start -->
        <div class="hero-single-slide hero-overlay">
            <img src="{{ asset('images/slider/'.$item->avatar) }}" alt="{{ $item->alt_text }}" class="img-slider">
        </div>
        <!-- single slider item start -->
        @endforeach
    </div>
</section>
