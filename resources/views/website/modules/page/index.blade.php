@extends('website.master')
@section('module', session('locale') == 'en' ? $pageDetail->name_en : $pageDetail->name_vn)
@section('keywords', $pageDetail->meta_keywords)
@section('description', $pageDetail->meta_description)
@section('images', asset('images/logo/' . $website->logo))
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('website.home')}}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $pageDetail->name_vn }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="about-us section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="about-content">
                    <h2 class="about-title">{{ $pageDetail->name_vn }}</h2>
                    {!! $pageDetail->content_vn !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection