@extends('layouts.frontend')

@section('seo')
    <title>{{ $systemInfo->name }} | Checkout</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $systemInfo->description }}">
    <meta name="keywords" content="{{ $systemInfo->description }}, {{ $systemInfo->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <!-- checkout section  -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-2 order-lg-1">
                    <form class="checkout-form" action="{{ route('checkout.store') }}" method="post">
                        @csrf
                        <div class="cf-title">Hoàn tất đặt hàng </div>
                        <div class="row">
                            <div class="col-md-7">
                                <p>Thông tin địa chỉ</p>
                            </div>
                        </div>
                        <div class="row address-inputs">
                            <div class="col-md-6">
                                <input type="text" name="billing_fullname" placeholder="Full Name"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="billing_email" placeholder="Email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="billing_address" placeholder="Address"
                                    value="{{ auth()->user()->address }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="billing_city" placeholder="City"
                                    value="{{ auth()->user()->city }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="billing_province" placeholder="Province or State"
                                    value="{{ auth()->user()->province }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="billing_phone" placeholder="Phone no."
                                    value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="notes"
                                    placeholder="Notes. Eg on delivery hoot or beep, am available Monday to Frinday 7am to 7pm"
                                    value="{{ auth()->user()->notes }}">
                            </div>
                        </div>

                        <div class="cf-title">Hình thức thanh toán</div>
                        <ul class="payment-list">
                            <li>
                                <input type="radio" name="payment_method" value="cash_on_delivery" required>
                                Thanh toán khi nhận hàng
                            </li>

                        </ul>

                        <button type="submit" class="site-btn submit-order-btn">Đặt hàng</button>
                    </form>
                </div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="checkout-cart">
                        <h3>Giỏ hàng</h3>
                        <ul class="product-list">
                            @foreach (Cart::content() as $item)
                                <li>
                                    <div class="pl-thumb">
                                        @if ($item->model->photos->count() > 0)
                                            <img src="/storage/{{ $item->model->photos->first()->images }}" alt="">
                                        @else
                                            <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                        @endif
                                    </div>
                                    <h6>{{ $item->model->name }}</h6>
                                    <p> {{ number_format($item->subtotal) }}đ </p>
                                    <p>Số lượng {{ $item->qty }}</p>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="price-list">
                            <li>Tạm tính<span> {{ number_format($newSubtotal) }}đ </span></li>
                            <li>Miễn phí vận chuyển</li>
                            <li class="total">Tổng<span> {{ number_format($newTotal) }}đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout section end -->
@endsection
