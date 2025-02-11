@extends('layouts.frontend')

@section('seo')
    <title>Chào mừng đến với | {{ $shareSettings->name }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $shareSettings->description }}">
    <meta name="keywords" content="{{ $shareSettings->name }}, {{ $shareSettings->name }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    @if ($slides->count() > 0)
        <!-- Hero section -->
        <section class="hero-section">
            <div class="hero-slider owl-carousel">
                @foreach ($slides as $slide)
                    <div class="hs-item set-bg" data-setbg="/storage/{{ $slide->image }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-7 text-white">
                                    <span>{{ $slide->heading }}</span>
                                    <p>{{ Str::limit($slide->description, 100) }}</p>
                                    <a href="/{{ $slide->link }}" class="site-btn sb-line">BUY NOW</a>
                                    <a href="{{ route('contact-us') }}" class="inquire site-btn sb-white">INQUIRE</a>
                                </div>
                            </div>
                            @if ($slide->from_price != null)
                                <div class="offer-card text-white">
                                    <span>from</span>
                                    <h3>${{ $slide->from_price }}</h3>
                                    <p>SHOP NOW</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="container">
                <div class="slide-num-holder" id="snh-1"></div>
            </div>
        </section>
        <!-- Hero section end -->
    @endif

    <!-- Features section -->
    <section class="features-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/1.png') }}" alt="#">
                        </div>
                        <h4>Fast Secure Payments</h4>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/2.png') }}" alt="#">
                        </div>
                        <h4 class="text-white">Premium Products</h4>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/3.png') }}" alt="#">
                        </div>
                        <h4>Affordable Delivery</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->


    <!-- letest product section -->
    <section class="top-letest-product-section">
        <div class="container">
            <div class="section-title">
                <h3>SẢN PHẨM MỚI NHẤT</h3>
            </div>
            <div class="product-slider owl-carousel">
                @foreach ($products as $p)
                    <div class="product-item">
                        <div class="pi-pic">
                            @if ($p->on_sale == 1)
                                <div class="tag-sale">GIẢM GIÁ</div>
                            @endif
                            @if ($p->is_new == 1)
                                <div class="tag-new">Mới</div>
                            @endif
                            <a href="{{ route('single-product', $p->slug) }}">
                                @if ($p->photos->count() > 0)
                                    <img src="/storage/{{ $p->photos->first()->images }} " alt="">
                                @else
                                    <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                @endif
                            </a>
                            <div class="pi-links">
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                    <input type="hidden" name="name" value="{{ $p->name }}">
                                    <input type="hidden" name="price" value="{{ $p->price }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-card"><i class="flaticon-bag"></i>
                                        <span>Thêm vào giỏ</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>${{ $p->price }}</h6>
                            <a href="{{ route('single-product', $p->slug) }}">
                                <p>{{ $p->name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- letest product section end -->



    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h3>CÁC SẢN PHẨM BÁN CHẠY NHẤT</h3>
            </div>
            <ul class="product-filter-menu">
                @foreach ($categories as $cat)
                    <li><a href="{{ route('frontendCategory', $cat->slug) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
            <div class="row">
                @foreach ($products as $p)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                @if ($p->on_sale == 1)
                                    <div class="tag-sale">ĐANG GIẢM GIÁ</div>
                                @endif
                                @if ($p->is_new == 1)
                                    <div class="tag-new">Mới</div>
                                @endif
                                <a href="{{ route('single-product', $p->slug) }}">
                                    <a href="{{ route('single-product', $p->slug) }}">
                                        @if ($p->photos->count() > 0)
                                            <img src="/storage/{{ $p->photos->first()->images }} " alt="">
                                        @else
                                            <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                        @endif
                                    </a>
                                </a>
                                <div class="pi-links">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <input type="hidden" name="name" value="{{ $p->name }}">
                                        <input type="hidden" name="price" value="{{ $p->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-card">
                                            <i class="flaticon-bag"></i>
                                            <span>Thêm vào giỏ</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="pi-text">
                                <h6>${{ $p->price }} </h6>
                                <p> {{ $p->name }} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($products->count() > 8)
                <div class="text-center pt-5">
                    <a href="{{ route('frontendCategories') }}" class="site-btn sb-line sb-dark">XEM THÊM</a>
                </div>
            @endif
        </div>
    </section>
    <!-- Product filter section end -->
@endsection
