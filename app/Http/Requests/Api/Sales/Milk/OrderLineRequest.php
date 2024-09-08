<?php

namespace App\Http\Requests\Api\Sales\Milk;

use Illuminate\Foundation\Http\FormRequest;

class OrderLineRequest extends FormRequest
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
            'sales_order_id' => ['required', 'exists:sales_orders,id'],
            'quantity' => ['nullable'],
            'product_id' => ['required', 'exists:products,id'],
            'fat_percentage' => ['required', 'min:0'],
            'protein_percentage' => ['required', 'min:0'],
            'bacteria_number' => ['required', 'min:0'],
            'total_farm_weight' => ['required'],
            'total_client_weight' => ['required'],
            'milk_items' => ['required', 'array'],
            'milk_items.*.station_id' => ['required', 'exists:stations,id'],
            'milk_items.*.weight' => ['required'],
            'price' => ['nullable']
        ];
    }
}
