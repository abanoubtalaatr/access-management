<?php

namespace App\Policies;

use App\Models\MilkWeight;
use App\Models\User;

class MilkWeightPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('milk weight:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MilkWeight $milkWeight): bool
    {
        return $user->hasPermissionTo('milk weight:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('milk weight:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MilkWeight $milkWeight): bool
    {
        return $user->hasPermissionTo('milk weight:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MilkWeight $milkWeight): bool
    {
        return $user->hasPermissionTo('milk weight:delete');
    }
}
