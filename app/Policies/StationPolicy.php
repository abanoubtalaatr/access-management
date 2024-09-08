<?php

namespace App\Policies;

use App\Models\Station;
use App\Models\User;

class StationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('station:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Station $station): bool
    {
        return $user->hasPermissionTo('station:view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('station:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Station $station): bool
    {
        return $user->hasPermissionTo('station:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Station $station): bool
    {
        return $user->hasPermissionTo('station:delete');
    }
}
