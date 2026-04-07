<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name'        => 'required|unique:products,name,' . $productId . '|max:100',
            'code'        => 'required|unique:products,code,' . $productId . '|max:20',
            'slug'        => 'unique:products',
            'description' => 'required',
            'images'      => 'nullable|array',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'price'       => 'required|numeric|gt:0',
            'quantity'    => 'required|numeric|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
