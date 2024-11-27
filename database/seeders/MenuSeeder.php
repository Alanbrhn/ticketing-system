<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name' => 'Dashboard',
                'icon' => 'icon-dashboard',
                'url' => '/dashboard',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'User Management',
                'icon' => 'icon-users',
                'url' => '/user-management',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Role Management',
                'icon' => 'icon-roles',
                'url' => '/role-management',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Permission Management',
                'icon' => 'icon-permissions',
                'url' => '/permission-management',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Settings',
                'icon' => 'icon-settings',
                'url' => null,
                'is_dropdown' => true,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Menu Management',
                'icon' => 'icon-menu',
                'url' => '/menu-management',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => 5, // Parent: Settings
            ],
            [
                'name' => 'Ticketing Management',
                'icon' => 'icon-ticketing',
                'url' => '/ticketing-management',
                'is_dropdown' => false,
                'is_active' => true,
                'parent_id' => 5, // Parent: Settings
            ],
        ];

        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($menus as $menuData) {
            $menu = Menu::create([
                'name' => $menuData['name'],
                'icon' => $menuData['icon'],
                'url' => $menuData['url'],
                'is_dropdown' => $menuData['is_dropdown'],
                'is_active' => $menuData['is_active'],
                'parent_id' => $menuData['parent_id'],
            ]);

            // Tambahkan permissions CRUD untuk menu
            foreach ($actions as $action) {
                $permissionName = "{$action}-" . strtolower(str_replace(' ', '-', $menuData['name']));
                $permission = Permission::firstOrCreate(['name' => $permissionName]); // Pastikan permission ada
                $menu->permissions()->attach($permission);
            }
        }
    }
}
