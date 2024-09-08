<?php

namespace App\Policies;

use App\Models\SalesOrderLine;
use App\Models\User;

class SalesOrderLinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('sales order line:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SalesOrderLine $salesOrderLine): bool
    {
        return $user->hasPermissionTo('sales order line:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('sales order line:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SalesOrderLine $salesOrderLine): bool
    {
        return $user->hasPermissionTo('sales order line:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SalesOrderLine $salesOrder): bool
    {
        return $user->hasPermissionTo('sales order line:delete');
    }
}
