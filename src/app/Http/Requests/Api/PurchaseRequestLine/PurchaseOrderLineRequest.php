<?php

namespace App\Http\Requests\Api\PurchaseRequestLine;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderLineRequest extends FormRequest
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
        return [
            'purchase_order_id' => ['required', 'exists:purchase_orders,id'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1'],
            'price' => ['nullable'],
        ];
    }
}
