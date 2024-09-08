<?php

namespace App\Policies;

use App\Models\SalesTransaction;
use App\Models\User;

class SalesTransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('sales transaction:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SalesTransaction $salesTransaction): bool
    {
        return $user->hasPermissionTo('sales transaction:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('sales transaction:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SalesTransaction $salesTransaction): bool
    {
        return $user->hasPermissionTo('sales transaction:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SalesTransaction $salesTransaction): bool
    {
        return $user->hasPermissionTo('sales transaction:delete');
    }
}
