<?php

namespace App\Http\Requests\Api;

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
        return [
            'name' => 'required|string|max:255|unique:products,name,'.$this->product?->id,
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'is_sellable' => 'required|boolean',
            'is_purchasable' => 'required|boolean',
            'selling_price' => ['nullable'],
            'purchasing_price' => ['nullable', 'min:1'],
            'is_milk' => ['required', 'boolean'],
            'tax' => ['sometimes'],
            'supplier' => ['nullable', 'exists:suppliers,id'],
            'supplier_price' => ['nullable', 'required_if:supplier,!=,'],
        ];
    }
}
