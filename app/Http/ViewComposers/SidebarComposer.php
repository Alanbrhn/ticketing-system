<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SidebarComposer
{
    public function compose(View $view)
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Jika tidak ada pengguna yang login, kita bisa langsung keluar
        if (!$user) {
            return $view->with('accessibleMenus', []);  // Mengirim menu kosong jika tidak ada pengguna yang login
        }

        // Ambil menu yang dapat diakses oleh user berdasarkan role dan permission
        $menus = DB::table('menus')
        ->join('menu_permissions', 'menus.id', '=', 'menu_permissions.menu_id')
        ->join('role_has_permissions', 'menu_permissions.permission_id', '=', 'role_has_permissions.permission_id')
        ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
        ->where('model_has_roles.model_id', $user->id)
        ->where('menus.is_enabled', 1)  // Pastikan menu aktif
        ->distinct()  // Pastikan setiap menu hanya muncul sekali
        ->select('menus.*')  // Pilih semua kolom dari tabel menus
        ->get();
    

        // Jika tidak ada menu yang dapat diakses, bisa dikembalikan tampilan kosong atau pesan tertentu
        if ($menus->isEmpty()) {
            return $view->with('accessibleMenus', []);
        }

        // Membagikan data menus ke semua view
        return $view->with('accessibleMenus', $menus);
    }
}
