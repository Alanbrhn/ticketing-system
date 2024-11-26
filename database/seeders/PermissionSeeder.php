<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            'dashboard',
            'user-management',
            'role-management',
            'permission-management',
            'menu-management',
            'ticketing-management',
            'approval-management',
        ];

        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($menus as $menu) {
            foreach ($actions as $action) {
                $permissionName = "{$action}-{$menu}";
                Permission::create(['name' => $permissionName, 'guard_name' => 'web']);
            }
        }
    }
}
