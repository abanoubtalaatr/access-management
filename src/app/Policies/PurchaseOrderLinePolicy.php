<?php

namespace App\Policies;

use App\Models\PurchaseOrderLine;
use App\Models\User;

class PurchaseOrderLinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('purchase order line:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PurchaseOrderLine $purchaseOrderLine): bool
    {
        return $user->hasPermissionTo('purchase order line:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('purchase order line:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PurchaseOrderLine $purchaseOrderLine): bool
    {
        return $user->hasPermissionTo('purchase order line:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PurchaseOrderLine $purchaseOrderLine): bool
    {
        return $user->hasPermissionTo('purchase order line:delete');
    }
}
