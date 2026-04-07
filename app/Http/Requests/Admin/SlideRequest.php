<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isCreate = $this->isMethod('post');

        return [
            'image' => ($isCreate ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
