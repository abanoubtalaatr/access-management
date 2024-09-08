<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RoleRequest;
use App\Http\Resources\Api\RoleResource;
use App\Http\Responses\Api\SuccessResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::query();

        $request->whenFilled('search', fn () => $roles->where(function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%");
        }));

        $roles = $roles->paginate();

        return RoleResource::collection($roles);
    }

    public function store(RoleRequest $request): RoleResource
    {
        // $this->authorize('create', Role::class);

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'api']);

        $permissionIds = $request->input('permissions', []);
        $permissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role->syncPermissions($permissionNames);

        return RoleResource::make($role);
    }

    public function show(Role $role): RoleResource
    {
        $this->authorize('view', $role);

        return RoleResource::make($role);
    }

    public function update(RoleRequest $request, Role $role): RoleResource
    {
        $this->authorize('update', $role);

        $role->update(['name' => $request->input('name')]);

        $permissionIds = $request->input('permissions', []);
        $permissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role->syncPermissions($permissionNames);

        return RoleResource::make($role);
    }

    public function destroy(Role $role): SuccessResponse
    {
        $this->authorize('delete', $role);

        $role->delete();

        return new SuccessResponse();
    }
}
