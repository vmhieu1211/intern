<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Nhận dữ liệu từ Facebook/Google sau khi đăng nhập.
     */
    public function callback($provider)
    {
        try {
            // Lấy thông tin người dùng từ provider (Facebook/Google)
            $socialUser = Socialite::driver($provider)->user();

            // Kiểm tra xem user đã tồn tại trong database chưa
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Nếu chưa tồn tại, tạo user mới
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(uniqid()), // Tạo mật khẩu ngẫu nhiên
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }

            // Đăng nhập user
            Auth::login($user, true);

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Có lỗi xảy ra khi đăng nhập.');
        }
    }
}
