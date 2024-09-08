<?php

namespace App\Policies;

use App\Models\ExpenseTransaction;
use App\Models\User;

class ExpenseTransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('expense transaction:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExpenseTransaction $expenseTransaction): bool
    {

        return $user->hasPermissionTo('expense transaction:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('expense transaction:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExpenseTransaction $expenseTransaction): bool
    {
        return $user->hasPermissionTo('expense transaction:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExpenseTransaction $expenseTransaction): bool
    {
        return $user->hasPermissionTo('expense transaction:delete');
    }
}
