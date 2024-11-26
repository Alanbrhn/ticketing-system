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
                'description' => 'Menu utama dashboard',
                'is_enabled' => true,
            ],
            [
                'name' => 'User Management',
                'icon' => 'icon-users',
                'url' => '/user-management',
                'description' => 'Manage users',
                'is_enabled' => true,
            ],
            [
                'name' => 'Role Management',
                'icon' => 'icon-roles',
                'url' => '/role-management',
                'description' => 'Manage roles',
                'is_enabled' => true,
            ],
            [
                'name' => 'Permission Management',
                'icon' => 'icon-permissions',
                'url' => '/permission-management',
                'description' => 'Manage permissions',
                'is_enabled' => true,
            ],
            [
                'name' => 'Menu Management',
                'icon' => 'icon-menu',
                'url' => '/menu-management',
                'description' => 'Manage menus',
                'is_enabled' => true,
            ],
            [
                'name' => 'Ticketing Management',
                'icon' => 'icon-ticketing',
                'url' => '/ticketing-management',
                'description' => 'Manage tickets',
                'is_enabled' => true,
            ],
            [
                'name' => 'Approval Management',
                'icon' => 'icon-approval',
                'url' => '/approval-management',
                'description' => 'Manage approvals',
                'is_enabled' => true,
            ],
        ];

        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($menus as $menuData) {
            $menu = Menu::create([
                'name' => $menuData['name'],
                'icon' => $menuData['icon'],
                'url' => $menuData['url'],
                'description' => $menuData['description'],
                'is_enabled' => $menuData['is_enabled'],
            ]);

            // Tambahkan permissions CRUD ke menu
            foreach ($actions as $action) {
                $permissionName = "{$action}-" . strtolower(str_replace(' ', '-', $menuData['name']));
                $permission = Permission::where('name', $permissionName)->first();
                $menu->permissions()->attach($permission);
            }
        }
    }
}
