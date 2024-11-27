<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\MenuService;

class SidebarComposer
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function compose(View $view)
    {
        $user = Auth::user();

        if (!$user) {
            return $view->with('accessibleMenus', []);
        }

        // Ambil menu dari MenuService
        $menus = $this->menuService->getAccessibleMenus($user->id);
        $menuTree = $this->buildMenuTree($menus);
        //dd($menuTree); // Pastikan data children sesuai

        return $view->with('accessibleMenus', $menuTree);
    }

    private function buildMenuTree($menus)
    {
        // Konversi stdClass menjadi array
        $menus = json_decode(json_encode($menus), true);

        // Buat mapping berdasarkan ID untuk mempermudah pencarian parent
        $menuMap = [];
        foreach ($menus as $menu) {
            $menu['children'] = [];
            $menuMap[$menu['id']] = $menu;
        }

        // Bangun tree
        $tree = [];
        foreach ($menus as $menu) {
            if ($menu['parent_id']) {
                // Tambahkan ke parent jika parent_id ada
                $menuMap[$menu['parent_id']]['children'][] = &$menuMap[$menu['id']];
            } else {
                // Jika tidak ada parent_id, masukkan ke tree utama
                $tree[] = &$menuMap[$menu['id']];
            }
        }

        return $tree;
    }



}
