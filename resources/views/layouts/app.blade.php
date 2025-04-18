<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    {{-- <link href="/storage/{{ $shareSettings->favicon }}" rel="shortcut icon" /> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <!-- font-owesome icons link -->
    <link href="{{ asset('frontend/fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <livewire:styles />
    @yield('css')
</head>

<body class="bg-dark">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark sticky-top shadow-sm border-bottom">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ route('home') }}">
                    Admin Dashboard </a>

                <a href="{{ url('/') }}" target="_blank" class="btn btn-success align-content-center"
                    style="outline: none; border: none; background-color: #fff; color: #000; margin-left: 50%;">Xem Giao
                    Diện Ứng Dụng</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link  text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link  text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-light" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ route('my-profile.edit') }}">Cài đặt</a> --}}

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 bg-dark">
            <div class="container">
                {{-- @auth --}}

                <div class="row">
                    <div class="col-md-3">

                        <ul class="list-group">

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('orders.index') }}" class="text-decoration-none text-light">Đơn
                                    hàng</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('categories.index') }}" class="text-decoration-none text-light">Danh
                                    mục</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('subcategories.index') }}"
                                    class="text-decoration-none text-light">Danh mục con</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('products.index') }}" class="text-decoration-none text-light">Sản
                                    phẩm</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('coupon.index') }}" class="text-decoration-none text-light">Mã giảm
                                    giá</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('contactMessages') }}" class="text-decoration-none text-light">Góp
                                    ý</a>
                            </li>


                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('users.index') }}" class="text-decoration-none text-light">Người
                                    dùng</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('system-settings.index') }}"
                                    class="text-decoration-none text-light">Cài đặt hệ thống</a>
                            </li>
                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('slides.index') }}"
                                    class="text-decoration-none text-light">Slides</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('roles.index') }}" class="text-decoration-none text-light">Vai
                                    trò</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('revenue.index') }}" class="text-decoration-none text-light">Doanh
                                    thu</a>
                            </li>

                            <li class="list-group-item bg-primary border-white">
                                <a href="{{ route('order-statuses.index') }}"
                                    class="text-decoration-none text-light">Trạng thái đơn hàng</a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-9">
                        @if (Session::has('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
                {{-- @else --}}
                {{-- @yield('content') --}}
                {{-- @endauth --}}
            </div>
        </main>
    </div>
</body>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<livewire:scripts />

@yield('scripts')

</html>
