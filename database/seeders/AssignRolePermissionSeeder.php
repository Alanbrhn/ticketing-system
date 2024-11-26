<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar role dan permissions
        $rolesPermissions = [
            'Admin' => [
                'create-dashboard', 'read-dashboard', 'update-dashboard', 'delete-dashboard',
                'create-user-management', 'read-user-management', 'update-user-management', 'delete-user-management',
                'create-role-management', 'read-role-management', 'update-role-management', 'delete-role-management',
                'create-permission-management', 'read-permission-management', 'update-permission-management', 'delete-permission-management',
                'create-menu-management', 'read-menu-management', 'update-menu-management', 'delete-menu-management',
                'create-ticketing-management', 'read-ticketing-management', 'update-ticketing-management', 'delete-ticketing-management',
                'create-approval-management', 'read-approval-management', 'update-approval-management', 'delete-approval-management',
            ],
            'User' => [
                'read-ticketing-management',
            ],
            'Sekretaris' => [
                'read-ticketing-management', 'read-approval-management',
            ],
            'Manager' => [
                'read-ticketing-management', 'read-approval-management',
            ],
        ];

        // Assign permissions menggunakan givePermissionTo
        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            if ($role) {
                foreach ($permissions as $permissionName) {
                    $permission = Permission::where('name', $permissionName)->first();

                    if ($permission) {
                        $role->givePermissionTo($permission);
                    } else {
                        $this->command->error("Permission {$permissionName} not found.");
                    }
                }
            } else {
                $this->command->error("Role {$roleName} not found.");
            }
        }
    }
}
