@extends('website.master')
@section('module', $detailNew->name_vn)
@section('keywords', $detailNew->meta_keywords)
@section('description', $detailNew->meta_description)
@section('images', asset('images/news/' . $detailNew->avatar))
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('website.home')}}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="blog-left-sidebar.html">{{ $detailNew->cate->name_vn }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $detailNew->name_vn }}</li>
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
            <div class="col-lg-3 order-2">
                <aside class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="title">Bài viết tương tự</h5>
                        <div class="recent-post">
                            @foreach($sameNews as $item)
                            <div class="recent-post-item">
                                <figure class="product-thumb">
                                    <a href="{{route('website.detailNew',['name_cate'=> $item->cate->slug,'name_new'=>$item->slug])}}">
                                        <img src="{{asset('images/news/'.$item->avatar)}}" alt="{{$item->name_vn}}">
                                    </a>
                                </figure>
                                <div class="recent-post-description">
                                    <div class="product-name">
                                        <h6><a href="{{route('website.detailNew',['name_cate'=> $item->cate->slug,'name_new'=>$item->slug])}}">{{$item->name_vn}}</a></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- single sidebar end -->
                </aside>
            </div>
            <div class="col-lg-9 order-1">
                <div class="blog-item-wrapper">
                    <!-- blog post item start -->
                    <div class="blog-post-item blog-details-post">
                        <div class="blog-content">
                            <h3 class="blog-title">
                                {{ $detailNew->name_vn }}
                            </h3>
                            <div class="blog-meta">
                                <p>{{ $detailNew->created_at->format('d/m/Y')}}</p>
                            </div>
                            <div class="entry-summary">
                               {!! $detailNew->content_vn !!}
                                <div class="blog-share-link">
                                    <h6>Share :</h6>
                                    <div class="blog-social-icon">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($detailNew->title) }}" class="twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="https://www.pinterest.com/pin/create/button/?url={{ url()->current() }}&description={{ urlencode($detailNew->title) }}" class="pinterest"><i class="fa fa-pinterest"></i></a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ urlencode($detailNew->title) }}" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog post item end -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection