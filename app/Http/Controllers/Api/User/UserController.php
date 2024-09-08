<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\Api\UserResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', User::class);

        return UserResource::collection(RequestQueryBuilder::build(User::query(), $request)->paginate());
    }

    public function store(StoreUserRequest $request): UserResource
    {
        $this->authorize('create', User::class);

        $user = User::create($request->except('role_id'));

        if ($request->has('role_id')) {
            $role = Role::find($request->input('role_id'));
            $user->syncRoles($role->name);
        }

        return UserResource::make($user);
    }

    public function show(User $user): UserResource
    {
        $this->authorize('view', $user);

        return UserResource::make($user);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);

        $user->update($request->except('role_id'));

        if ($request->has('role_id')) {
            $role = Role::find($request->input('role_id'));
            $user->syncRoles($role->name);
        }

        return UserResource::make($user->refresh());
    }

    public function destroy(User $user): SuccessResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return new SuccessResponse();
    }
}
