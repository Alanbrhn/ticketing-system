<?php

namespace App\Livewire\Core;

use Livewire\Component;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class SidebarMenu extends Component
{
    public $accessibleMenus = [];

    protected $menuService;

    public function __construct()
    {
        $this->menuService = app(MenuService::class); // Resolusi service
    }

    public function mount()
    {
        $user = Auth::user();

        if ($user) {
            $menus = $this->menuService->getAccessibleMenus($user->id);
            $this->accessibleMenus = $this->buildMenuTree($menus);
        }
    }

    private function buildMenuTree($menus)
    {
        $menus = $menus->toArray(); 
    
        $menuMap = [];
        foreach ($menus as $menu) {
            $menu['children'] = [];
            $menuMap[$menu['id']] = $menu;
        }
    
        $tree = [];
        foreach ($menus as $menu) {
            if ($menu['parent_id']) {
                $menuMap[$menu['parent_id']]['children'][] = &$menuMap[$menu['id']];
            } else {
                $tree[] = &$menuMap[$menu['id']];
            }
        }
    
        return $tree;
    }
    

    public function render()
    {
        return view('livewire.core.sidebar-menu');
    }
}

