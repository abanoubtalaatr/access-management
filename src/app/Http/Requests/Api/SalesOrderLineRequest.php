<?php

namespace App\Http\Requests\Api;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class SalesOrderLineRequest extends FormRequest
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
            'sales_order_id' => ['required', 'exists:purchase_orders,id'],
            'product_id' => ['required', 'exists:products,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'quantity' => ['required', 'min:1'],
            'price' => ['required', 'min:0'],
        ];
    }

    public function validatedItems(): array
    {
        $validated = $this->validated();

        return collect($validated['items'])->map(function ($item) {
            $product = Product::findOrFail($item['product_id']);
            $tax = $product->tax ?? 10;
            $price = $item['quantity'] * $product->selling_price;
            $total = $price + ($tax / 100 * $price);

            return [
                'sales_order_id' => $this->sales_order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total' => $total,
                'price' => $price,
                'taxes' => $tax,
            ];
        })->toArray();
    }
}
