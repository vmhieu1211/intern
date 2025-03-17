@extends('layouts.frontend')

<title>Đăng ký</title>
<meta charset="UTF-8">
<meta name="description" content="Login">
<meta name="keywords" content="login, sign">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@section('css')
    {{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}
@endsection

@section('content')
    <div class="card col-lg col-xl-9 flex-row mx-auto px-0">
        {{-- <div class="img-left d-none d-md-flex"></div> --}}

        <div class="card-body">
            <h4 class="title text-center mt-2 mb-3">Tạo tài khoản</h4>
            <form class="form-box px-3"method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-input">
                    <span><i class="fa fa-user"></i></span>
                    <input name="name" type="text" placeholder="Họ tên"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>

                    @error('name')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <span><i class="fa fa-envelope"></i></span>
                    <input name="email" type="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                    @error('email')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <span><i class="fa fa-key"></i></span>
                    <input type="password" name="password" placeholder="Mật khẩu"
                        class="form-control @error('password') is-invalid @enderror" required>

                    @error('password')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <span><i class="fa fa-key"></i></span>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                        class="form-control @error('password_confirmation') is-invalid @enderror">

                    @error('password_confirmation')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-block">Đăng ký</button>
                </div>

                <div class="text-center mb-2">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="register-link">Đăng nhập tại đây</a>
                </div>
            </form>
        </div>

    </div>
@endsection
