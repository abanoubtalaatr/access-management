<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;

class SupplierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {

        return $user->hasPermissionTo('supplier:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, supplier $supplier): bool
    {
        return $user->hasPermissionTo('supplier:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('supplier:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, supplier $supplier): bool
    {

        return $user->hasPermissionTo('supplier:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, supplier $supplier): bool
    {
        return $user->hasPermissionTo('supplier:delete');
    }
}
