<?php

namespace App\Policies;

use App\Models\PurchaseOrderTransaction;
use App\Models\User;

class PurchaseOrderTransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('purchase order transaction:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseOrderTransaction $purchaseOrderTransaction): bool
    {
        return $user->hasPermissionTo('purchase order transaction:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('purchase order transaction:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseOrderTransaction $purchaseOrderTransaction): bool
    {
        return $user->hasPermissionTo('purchase order transaction:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseOrderTransaction $purchaseOrderTransaction): bool
    {
        return $user->hasPermissionTo('purchase order transaction:delete');
    }
}
