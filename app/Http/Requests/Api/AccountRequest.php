<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:accounts,name,'.$this->account?->id],
            'accountable_id' => ['required', 'integer'],
            'accountable_type' => ['required', 'string', 'in:App\Models\Station,App\Models\Client,App\Models\Supplier'],
            'is_global' => ['sometimes', 'boolean'],
        ];
    }
}
