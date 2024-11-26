<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();
        
        // Cek apakah pengguna sudah login
        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil menu yang dapat diakses oleh user berdasarkan role dan permission
        $menus = DB::table('menus')
            ->join('menu_permissions', 'menus.id', '=', 'menu_permissions.menu_id')
            ->join('role_has_permissions', 'menu_permissions.permission_id', '=', 'role_has_permissions.permission_id')
            ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', $user->id)
            ->where('menus.is_enabled', 1)  // Pastikan menu aktif
            ->select('menus.*')
            ->get();

        // Menyimpan menu yang dapat diakses ke dalam session atau memberikan akses ke view
        $request->session()->put('accessible_menus', $menus);

        // Melanjutkan request ke controller berikutnya
        return $next($request);
    }
}

