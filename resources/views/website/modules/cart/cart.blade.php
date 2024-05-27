@extends('website.master')
@section('module', session('locale') == 'en' ? 'Cart' : 'Giỏ hàng')
@section('keywords', $website->meta_keyword)
@section('description', $website->meta_description)
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
                                <li class="breadcrumb-item"><a href="{{ route('website.home') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <form class="cart-form" action="{{ route('website.updateCart') }}" method="post">
                            @csrf
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Avatar</th>
                                        <th class="pro-title">Sản phẩm</th>
                                        <th class="pro-price">Giá</th>
                                        <th class="pro-quantity">SL</th>
                                        <th class="pro-subtotal">Tổng</th>
                                        <th class="pro-remove">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td class="pro-thumbnail"><a
                                                    href="{{ route('website.detailProduct', ['name_cate' => Str::of($item->options->name_cate)->slug('-'), 'name_product' => Str::of($item->name)->slug('-')]) }}"><img
                                                        class="img-fluid"
                                                        src="{{ asset('images/products/' . $item->options->avatar) }}"
                                                        alt="{{ $item->name }}" /></a></td>
                                            <td class="pro-title"><a
                                                    href="{{ route('website.detailProduct', ['name_cate' => Str::of($item->options->name_cate)->slug('-'), 'name_product' => Str::of($item->name)->slug('-')]) }}">{{ $item->name }}</a>
                                            </td>
                                            @php
                                                if ($item->options->discount == 0) {
                                                    $displayPrice = $item->price;
                                                } else {
                                                    $displayPrice = $item->price * (1 - $item->options->discount / 100);
                                                }
                                            @endphp
                                            <td class="pro-price"><span>{{ number_format($displayPrice) }} VND</span></td>
                                            <td class="pro-quantity">
                                                <div class="pro-qty"><input type="text" value="{{ $item->qty }}"
                                                        name="quantity[{{ $item->rowId }}]"></div>
                                            </td>
                                            <td class="pro-subtotal"><span>{{ number_format($displayPrice * $item->qty) }}
                                                    VND</span></td>
                                            <td class="pro-remove"><a href="{{ route('website.removeItemCart', ['id' => $item->rowId]) }}"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                        @php
                                            $total += $displayPrice * $item->qty;
                                        @endphp
                                    @endforeach
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                        <div class="cart-update-option d-block d-md-flex justify-content-between">
                            <div class="apply-coupon-wrapper">
                            </div>
                            <div class="cart-update">
                                <button type="submit"  class="btn btn-sqr">Cập nhật</button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng giỏ hàng</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng cộng </td>
                                            <td>{{ number_format($total) }} VND</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Thành tiền</td>
                                            <td class="total-amount">{{ number_format($total) }} VND</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="{{route('website.checkout')}}" class="btn btn-sqr d-block">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection
