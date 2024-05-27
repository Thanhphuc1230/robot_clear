@extends('website.master')
@section('module', $categoryProduct->name_vn)
@section('keywords', $categoryProduct->meta_keywords)
@section('description', $categoryProduct->meta_description)
@section('images', asset('images/logo/' . $website->logo))
@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Sản phẩm</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    @foreach($cateProduct as $item)
                                    <li><a href="{{route('website.categoryProduct', ['name_cate_product' => $item->slug])}}">{{$item->name_vn}} <span>({{$item->products->count()}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Brand</h5>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Studio (3)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Hastech (4)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">Quickiin (15)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Graphic corner
                                                (10)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5">devItems (12)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="assets/img/banner/sidebar-banner.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"
                                                data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Showing 1–16 of 21 results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            @foreach ($products as $item)
                                <!-- product single item start -->
                                <div class="col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a
                                                href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">
                                                <img class="pri-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                    alt="{{ $item->name_vn }}">
                                                <img class="sec-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                    alt="{{ $item->name_vn }}">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Quick View"><i
                                                            class="pe-7s-search"></i></span></a>
                                            </div>
                                            <div class="cart-hover">
                                                <button class="btn btn-cart">add to cart</button>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                                <p class="manufacturer-name"><a
                                                        href="{{route('website.categoryProduct', ['name_cate_product' => $item->cate->slug])}}">{{ $item->cate->name_vn }}</a></p>
                                            </div>
                                            <h6 class="product-name">
                                                <a
                                                    href="{{ route('website.detailProduct', ['name_cate' => $item->cate->slug, 'name_product' => $item->slug]) }}">{{ $item->name_vn }}</a>
                                            </h6>
                                            <div class="price-box">
                                                @php
                                                    $discountedPrice = $item->price * 0.9;
                                                @endphp
                                                <span class="price-regular">{{ number_format($discountedPrice) }}
                                                    VND</span>
                                                <span
                                                    class="price-old"><del>{{ number_format($item->price) }}VND</del></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->

                                    <!-- product list item end -->
                                    <div class="product-list-item">
                                        <figure class="product-thumb">
                                            <a href="{{route('website.detailProduct',['name_cate'=>$item->cate->slug,'name_product'=>$item->slug])}}">
                                                <img class="pri-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                    alt="{{ $item->name_vn }}">
                                                <img class="sec-img" src="{{ asset('images/products/' . $item->avatar) }}"
                                                    alt="{{ $item->name_vn }}">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Quick View"><i
                                                            class="pe-7s-search"></i></span></a>
                                            </div>
                                            <div class="cart-hover">
                                                <button class="btn btn-cart">add to cart</button>
                                            </div>
                                        </figure>
                                        <div class="product-content-list">
                                            <div class="manufacturer-name">
                                                <a href="{{route('website.categoryProduct', ['name_cate_product' => $item->cate->slug])}}">{{ $item->cate->name_vn }}</a>
                                            </div>
                                            <h5 class="product-name"><a
                                                    href="{{route('website.detailProduct',['name_cate'=>$item->cate->slug,'name_product'=>$item->slug])}}">{{ $item->name_vn }}</a></h5>
                                            <div class="price-box">
                                                @php
                                                    $discountedPrice = $item->price * 0.9;
                                                @endphp
                                                <span class="price-regular">{{ number_format($discountedPrice) }}
                                                    VND</span>
                                                <span
                                                    class="price-old"><del>{{ number_format($item->price) }}VND</del></span>
                                            </div>
                                            <p>{!! $item->intro_vn !!}</p>
                                        </div>
                                    </div>
                                    <!-- product list item end -->
                                </div>
                                <!-- product single item start -->
                            @endforeach
                        </div>
                        <!-- product item list wrapper end -->

                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            {!! $products->links() !!}
                        </div>
            
                        <!-- end pagination area -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
@endsection
