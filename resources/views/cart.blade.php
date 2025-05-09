@extends('layouts.frontend')

@section('seo')
    <title>
        @if (auth()->check())
            {{ auth()->user()->name }} 's Cart
        @else
            Cart
        @endif
    </title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $systemInfo->description }}">
    <meta name="keywords" content="{{ $systemInfo->description }}, {{ $systemInfo->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
    <!-- cart section end -->
    <section class="cart-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table">
                        <h3>Giỏ hàng của bạn</h3>
                        <div class="cart-table-warp">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-th">Sản phẩm</th>
                                        <th class="quy-th"> Số lượng</th>
                                        <th class="total-th">Giá </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                    <tr>
                                        <td class="product-col">
                                            <a href="{{ route('single-product', $item['id']) }}">
                                                <img src="/storage/{{ $item['image'] }}" alt="">
                                            </a>
                                            <div class="pc-title">
                                                <h4>{{ $item['name'] }}</h4>
                                            </div>
                                        </td>
                                        <td class="quy-col">
                                            <div class="quantity">
                                                <form action="{{ route('cart.update', $item['id']) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity" value="{{ $item['quantity'] }}">
                                                    </div>
                                                    <button style="border: none;">
                                                        <i class="cancel fas fa-check ml-2" title="Update Product Qty" style="cursor: pointer; color: #00FF00;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="total-col">
                                            <h4>{{ number_format($item['price'] * $item['quantity'], 0) }}đ</h4>
                                        </td>
                                        <td class="total-col">
                                            <form action="{{ route('cart.destroy', $item['id']) }}" method="post">
                                                @csrf
                                                <button style="border: none;">
                                                    <i class="cancel fas fa-times" title="Remove Product" style="cursor: pointer; color: #f51167;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                    @if (session()->get('coupon') != null)
                                        <tr>
                                            <td>Mã giảm giá ({{ session()->get('coupon')['name'] }})</td>
                                            <td>
                                                <form action="{{ route('coupons.destroy') }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="border: none;">
                                                        <i class="cancel fas fa-times" title="Remove coupon"
                                                            style="cursor: pointer; color: #f51167;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td></td>
                                            <td>-{{ number_format($discount) }}đ </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Thành tiền</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong> {{ number_format($newSubtotal) }}đ</strong></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="total-cost">
                            <h6>Tổng <span> {{ number_format($newTotal) }} đ</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 card-right">
                    @if (!session()->has('coupon'))
                        <form action="{{ route('coupons.store') }}" class="promo-code-form" method="post">
                            @csrf
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter promo code">
                            <button type="submit">Sử dụng</button>
                        </form>
                    @endif
                    <a href="{{ route('checkout.index') }}" class="site-btn">Thanh toán</a>
                    <a href="{{ route('frontendCategories') }}" class="site-btn sb-dark">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </section>
    <!-- cart section end -->

    <!-- Related product section -->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title text-uppercase">
                <h2>Có thể bạn cũng thích</h2>
            </div>
            <div class="row">
                @foreach ($mightAlsoLike as $like)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                @if ($like->on_sale == 1)
                                    <div class="tag-sale">GIẢM GIÁ</div>
                                @endif
                                @if ($like->is_new == 1)
                                    <div class="tag-new">Mới</div>
                                @endif
                                <a href="{{ route('single-product', $like->slug) }}">
                                    @if ($like->photos->count() > 0)
                                        <img src="/storage/{{ $like->photos->first()->images }}" alt="">
                                    @else
                                        <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                    @endif
                                </a>
                                <div class="pi-links">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $like->id }}">
                                        <input type="hidden" name="name" value="{{ $like->name }}">
                                        <input type="hidden" name="price" value="{{ $like->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-card"><i class="flaticon-bag"></i><span>THÊM VÀO
                                                GIỎ HÀNG</span></button>
                                    </form>

                                </div>
                            </div>
                            <div class="pi-text">
                                <h6>{{ number_format($like->price) }}đ</h6>
                                <p>{{ $like->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related product section end -->
@endsection
