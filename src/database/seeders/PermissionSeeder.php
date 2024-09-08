<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'user:viewAny',
            'user:view',
            'user:create',
            'user:update',
            'user:delete',

            'invitation:viewAny',
            'invitation:view',
            'invitation:create',
            'invitation:update',
            'invitation:delete',

            'role:viewAny',
            'role:view',
            'role:create',
            'role:update',
            'role:delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(
                ['name' => $permissionName, 'guard_name' => 'api'],
                ['name' => $permissionName, 'guard_name' => 'api']
            );
        }

        $role = Role::updateOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $role->givePermissionTo($permissions);

        foreach (User::all() as $user) {
            $user->assignRole('admin');
        }
    }
}
