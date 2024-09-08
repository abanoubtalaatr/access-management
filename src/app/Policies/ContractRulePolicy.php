<?php

namespace App\Policies;

use App\Models\ContractRule;
use App\Models\User;

class ContractRulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('contract rule:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContractRule $contractRule): bool
    {
        return $user->hasPermissionTo('contract rule:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('contract rule:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContractRule $contract): bool
    {
        return $user->hasPermissionTo('contract rule:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContractRule $contract): bool
    {
        return $user->hasPermissionTo('contract rule:delete');
    }
}
