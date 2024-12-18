<?php

namespace Database\Seeders;

use App\Constants\Permission;
use App\Constants\Role;
use Illuminate\Database\Seeder;
class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Permission::generalPermission() as $permission) {
            \App\Models\Permission::query()->firstOrCreate(
                [
                    'name' => $permission,
                    'guard_name' => 'web',
                ], [
                    'created_at' => -1,
                    'updated_at' => -1
                ]
            );
        }

        foreach (Role::generalRole() as $role) {
            $role = \App\Models\Role::query()->firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ], [
                'created_at' => -1,
                'updated_at' => -1,
            ]);

            $permissions = Permission::getPermissionByRole($role->name);
            $role->syncPermissions($permissions);
        }
    }


}
