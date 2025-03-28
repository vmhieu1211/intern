@extends('layouts.frontend')

@section('content')
    <div class="card col-lg col-xl-9 flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
            <h4 class="title text-center mt-2 mb-3">Đặt lại mật khẩu</h4>
            <form class="form-box px-3"method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-input">
                    <span><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" tabindex="10"
                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                        required>

                    @error('email')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-block">Gửi Email</button>
                </div>

                <div class="text-center mb-2">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="register-link">Đăng ký tại đây</a>
                </div>
            </form>
        </div>

    </div>
@endsection
