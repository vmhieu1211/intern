<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'billing_fullname' => 'required|string|max:255',
            'billing_address'  => 'required|string|max:500',
            'billing_city'     => 'required|string|max:100',
            'billing_province' => 'required|string|max:100',
            'billing_phone'    => 'required|string|max:20',
            'billing_email'    => 'nullable|email|max:255',
            'notes'            => 'nullable|string|max:255',
            'payment_method'   => 'nullable|string|max:50',
        ];
    }

    public function attributes(): array
    {
        return [
            'billing_fullname' => 'họ tên',
            'billing_address'  => 'địa chỉ',
            'billing_city'     => 'thành phố',
            'billing_province' => 'tỉnh/thành',
            'billing_phone'    => 'số điện thoại',
            'billing_email'    => 'email',
            'notes'            => 'ghi chú',
        ];
    }
}
