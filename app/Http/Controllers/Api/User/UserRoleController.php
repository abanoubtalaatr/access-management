<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AssignRoleRequest;
use App\Http\Responses\Api\FailResponse;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function store(AssignRoleRequest $request, User $user): SuccessResponse|FailResponse
    {
        $role = Role::find($request->input('role_id'));

        if ($user->hasRole($role->name)) {
            return new FailResponse();
        }
        $user->assignRole($role->name);

        return new SuccessResponse();
    }

    public function destroy(Request $request, User $user): SuccessResponse|FailResponse
    {
        $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $role = Role::find($request->input('role_id'));

        if (! $role) {
            return new FailResponse();
        }

        if (! $user->hasRole($role->name)) {
            return new FailResponse();
        }

        $user->removeRole($role->name);

        return new SuccessResponse();
    }
}
