<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('user:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(user $user): bool
    {
        return $user->hasPermissionTo('user:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('user:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(user $user): bool
    {
        return $user->hasPermissionTo('user:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(user $user): bool
    {
        return $user->hasPermissionTo('user:delete');
    }
}
