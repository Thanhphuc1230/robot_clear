@extends('website.master')
@section('module', session('locale') == 'en' ? $categoryNews->name_en : $categoryNews->name_vn)
@section('keywords', $categoryNews->meta_keywords)
@section('description', $categoryNews->meta_description)
@section('images', asset('website_style/images/logo/' . $website->logo))
@section('content')

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$categoryNews->name_vn}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <aside class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="title">search</h5>
                        <div class="sidebar-serch-form">
                            <form action="#">
                                <input type="text" class="search-field" placeholder="search here">
                                <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div> <!-- single sidebar end -->
                    <div class="blog-sidebar">
                        <h5 class="title">categories</h5>
                        <ul class="blog-archive blog-category">
                            <li><a href="#">Barber (10)</a></li>
                            <li><a href="#">fashion (08)</a></li>
                            <li><a href="#">handbag (07)</a></li>
                            <li><a href="#">Jewelry (14)</a></li>
                            <li><a href="#">food (10)</a></li>
                        </ul>
                    </div> <!-- single sidebar end -->
                    <div class="blog-sidebar">
                        <h5 class="title">Blog Archives</h5>
                        <ul class="blog-archive">
                            <li><a href="#">January (10)</a></li>
                            <li><a href="#">February (08)</a></li>
                            <li><a href="#">March (07)</a></li>
                            <li><a href="#">April (14)</a></li>
                            <li><a href="#">May (10)</a></li>
                        </ul>
                    </div> <!-- single sidebar end -->
                    <div class="blog-sidebar">
                        <h5 class="title">recent post</h5>
                        <div class="recent-post">
                            <div class="recent-post-item">
                                <figure class="product-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img1.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="recent-post-description">
                                    <div class="product-name">
                                        <h6><a href="blog-details.html">Auctor gravida enim</a></h6>
                                        <p>march 10 2019</p>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post-item">
                                <figure class="product-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img2.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="recent-post-description">
                                    <div class="product-name">
                                        <h6><a href="blog-details.html">gravida auctor dnim</a></h6>
                                        <p>march 18 2019</p>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post-item">
                                <figure class="product-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img3.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="recent-post-description">
                                    <div class="product-name">
                                        <h6><a href="blog-details.html">enim auctor gravida</a></h6>
                                        <p>march 14 2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- single sidebar end -->
                    <div class="blog-sidebar">
                        <h5 class="title">Tags</h5>
                        <ul class="blog-tags">
                            <li><a href="#">camera</a></li>
                            <li><a href="#">computer</a></li>
                            <li><a href="#">bag</a></li>
                            <li><a href="#">watch</a></li>
                            <li><a href="#">smartphone</a></li>
                            <li><a href="#">shoes</a></li>
                        </ul>
                    </div> <!-- single sidebar end -->
                </aside>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="blog-item-wrapper blog-list-inner">
                    <!-- blog item wrapper end -->
                    <div class="row mbn-30">
                        @foreach($news as $item)
                        <div class="col-12">
                            <!-- blog post item start -->
                            <div class="blog-post-item mb-30">
                                <figure class="blog-thumb">
                                    <a href="{{route('website.detailNew',['name_cate'=> $item->cate->slug,'name_new'=>$item->slug])}}">
                                        <img src="{{asset('images/news/'.$item->avatar)}}" alt="{{$item->name_vn}}">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <h4 class="blog-title">
                                        <a href="{{route('website.detailNew',['name_cate'=> $item->cate->slug,'name_new'=>$item->slug])}}">{{$item->name_vn}}</a>
                                    </h4>
                                    <p>{{$item->intro_vn}}</p>
                                    <a class="blog-read-more" href="{{route('website.detailNew',['name_cate'=> $item->cate->slug,'name_new'=>$item->slug])}}">Xem Thêm...</a>
                                </div>
                            </div>
                            <!-- blog post item end -->
                        </div>
                        @endforeach
                    </div>
                    <!-- blog item wrapper end -->

                    <!-- start pagination area -->
                    <div class="paginatoin-area text-center">
                        <ul class="pagination-box">
                            {!! $news->links() !!}
                        </ul>
                    </div>
                    <!-- end pagination area -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection