<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContractRuleRequest extends FormRequest
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
            'contract_id' => ['required', 'exists:contracts,id'],
            'number_or_percentage' => ['required'],
            'fee_per_liter' => ['required'],
            'is_protein' => ['required', 'boolean'],
            'is_bacteria' => ['required', 'boolean'],
            'is_fat' => ['required', 'boolean'],
        ];
    }
}
