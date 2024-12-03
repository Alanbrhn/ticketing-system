<?php

namespace App\services;

use Illuminate\Support\Facades\DB;

class MenuService
{
    public function getAccessibleMenus($userId)
    {
        return DB::table('menus')
        ->join('menu_permissions', 'menus.id', '=', 'menu_permissions.menu_id')
        ->join('role_has_permissions', 'menu_permissions.permission_id', '=', 'role_has_permissions.permission_id')
        ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
        ->leftJoin('icons', 'menus.icon', '=', 'icons.IconName') // Join tabel icons
        ->where('model_has_roles.model_id', $userId)
        ->where('menus.is_active', 1) // Pastikan menu aktif
        ->distinct()
        ->select('menus.*', 'icons.FilePath') // Tambahkan FilePath dari tabel icons
        ->get()
        ->map(function ($menu) {
            return (object) $menu; // Convert setiap item ke object
        });

    }
}
