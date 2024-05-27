@extends('website.master')
@section('module', $website->meta_name)
@section('keywords', $website->meta_keyword)
@section('description', $website->meta_description)
@section('images', asset('images/logo/' . $website->logo))

@section('content')
    <!-- hero slider area start -->
    @include('website.partials.slider')
    <!-- hero slider area end -->

    <!-- service policy area start -->
    @include('website.partials.service')
    <!-- service policy area end -->
    <!-- hot deals area start -->
    <section class="hot-deals section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Flash Sale</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="deals-carousel-active--two slick-row-10 slick-arrow-style">
                        @foreach ($flashSale as $item)
                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a
                                        href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">
                                        <img src="{{ asset('images/products/' . $item->avatar) }}"
                                            alt="{{ $item->name_vn }}" loading="lazy">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                    class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a
                                                href="{{ route('website.categoryProduct', ['name_cate_product' => $item->cate->slug]) }}">{{ $item->cate->name_vn }}</a>
                                        </p>
                                    </div>
                                    <h6 class="product-name">
                                        <a
                                            href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">{{ Str::words($item->name_vn, 10) }}</a>
                                    </h6>
                                    <div class="price-box">
                                        @if ($item->discount != 0)
                                            @php
                                                $discountedPrice =
                                                    $item->price - ($item->price * $item->discount) / 100;
                                            @endphp
                                            <span class="price-regular">{{ number_format($discountedPrice) }}
                                                VND</span>
                                            <span class="price-old"><del>{{ number_format($item->price) }}VND</del></span>
                                        @else
                                            <span class="price-regular">{{ number_format($item->price) }}
                                                VND</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- hot deals item end -->
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hot deals area end -->

    <!-- product banner statistics area start -->
    <section class="product-banner-statistics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="product-banner-carousel slick-row-10">
                        @foreach ($cateProduct as $item)
                            <!-- banner single slide start -->
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="#">
                                        <img class="img-cate" src="{{ asset('images/category_product/' . $item->avatar) }}"
                                            alt="{{ $item->name_vn }}">
                                    </a>
                                    <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="#">{{ $item->name_vn }}</a></h5>
                                    </div>
                                </figure>
                            </div>
                            <!-- banner single slide start -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product banner statistics area end -->

    @foreach ($categoryProductHot as $cate)
        <!-- product area start -->
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">{{ $cate->name_vn }}</h2>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                            @foreach ($cate->products as $item)
                                <!-- product item start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a
                                            href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">
                                            <img class="pri-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                alt="{{ $item->name_vn }}" loading="lazy">
                                            <img class="sec-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                alt="{{ $item->name_vn }}" loading="lazy">
                                        </a>
                                        <div class="product-badge">
                                            <div class="product-label new">
                                                <span>new</span>
                                            </div>
                                            @if ($item->discount != 0)
                                                <div class="product-label discount">
                                                    <span>{{ $item->discount }}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                            <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Quick View"><i class="pe-7s-search"></i></span></a>
                                        </div>
                                        <div class="cart-hover">
                                            <button class="btn btn-cart">add to cart</button>
                                        </div>
                                    </figure>
                                    <div class="product-caption text-center">
                                        <div class="product-identity">
                                            <p class="manufacturer-name"><a
                                                    href="{{ route('website.categoryProduct', ['name_cate_product' => $item->cate->slug]) }}">{{ $item->cate->name_vn }}</a>
                                            </p>
                                        </div>
                                        <h6 class="product-name">
                                            <a
                                                href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">{{ Str::words($item->name_vn, 10) }}</a>
                                        </h6>
                                        <div class="price-box">
                                            @if ($item->discount != 0)
                                                @php
                                                    $discountedPrice =
                                                        $item->price - ($item->price * $item->discount) / 100;
                                                @endphp
                                                <span class="price-regular">{{ number_format($discountedPrice) }}
                                                    VND</span>
                                                <span
                                                    class="price-old"><del>{{ number_format($item->price) }}VND</del></span>
                                            @else
                                                <span class="price-regular">{{ number_format($item->price) }}
                                                    VND</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- product item end -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product area end -->
    @endforeach



    <!-- latest blog area start -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Tin tức</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        @foreach ($latestNew as $item)
                            <!-- blog post item start -->
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                    <a
                                        href="{{ route('website.detailNew', ['name_cate' => $item->cate->slug, 'name_new' => $item->slug]) }}">
                                        <img src="{{ asset('images/news/' . $item->avatar) }}"
                                            alt="{{ $item->name_vn }}">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <h5 class="blog-title">
                                        <a
                                            href="{{ route('website.detailNew', ['name_cate' => $item->cate->slug, 'name_new' => $item->slug]) }}">{{ Str::words($item->name_vn, 10) }}</a>
                                    </h5>
                                </div>
                            </div>
                            <!-- blog post item end -->
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest blog area end -->

@endsection
