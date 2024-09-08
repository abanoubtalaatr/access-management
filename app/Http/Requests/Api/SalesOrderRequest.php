<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SalesOrderRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'delivery_date' => ['required', 'date'],
            'payment_due_date' => ['required', 'date'],
            'is_milk_sales' => ['required', 'boolean'],
            'description' => ['required', 'string', 'min:3'],
            'invoice_number' => ['nullable', 'string', 'min:3']
        ];
    }
}
