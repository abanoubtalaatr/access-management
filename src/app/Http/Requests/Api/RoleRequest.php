<?php

namespace BirdSol\AccessManagement\App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        // Use the route parameter to get the role ID for the ignore method
        $roleId = $this->route('role');

        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('roles', 'name')->ignore($roleId)],
            'permissions' => ['required', 'array', 'exists:permissions,id'],
        ];
    }
}
