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
            'name' => 'required|unique:products,name,' . $productId . '|max:100',
            'code' => 'required|unique:products,code,' . $productId . '|max:20',
            'slug' => 'unique:products',
            'description' => 'required',
            'images' => 'nullable|array',
            'price' => 'required|numeric|gt:0',
            'quantity' => 'required|numeric|integer',
            'category_id' => 'required',
        ];
    }
}
