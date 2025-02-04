<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStatusRequest extends FormRequest
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
        $orderStatus = $this->route('order_status')?->id;
        // dd($orderStatus);
        return [
            'name' => 'required|unique:order_statuses,name,' . $orderStatus,
            'identify_name' => 'required|unique:order_statuses,identify_name,' . $orderStatus,
        ];
    }
}
