<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil menu menggunakan MenuService
        $menus = $this->menuService->getAccessibleMenus($user->id);

        // Simpan menu ke session
        $request->session()->put('accessible_menus', $menus);

        return $next($request);
    }
}
