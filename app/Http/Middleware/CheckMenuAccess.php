<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    protected $menuService;

    /**
     * Konstruktor untuk dependency injection MenuService
     *
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Menangani request dan memeriksa akses menu
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); 
        }

        // if (!$request->session()->has('accessible_menus')) {
        //     $menus = $this->menuService->getAccessibleMenus($user->id);
        //     $request->session()->put('accessible_menus', $menus);
        // } else {
        if (!cache()->has("user_{$user->id}_accessible_menus")) {
                $menus = $this->menuService->getAccessibleMenus($user->id);
                cache()->put("user_{$user->id}_accessible_menus", $menus, now()->addMinutes(60));
        } else {
            $menus = $request->session()->get('accessible_menus');
        }

        return $next($request);
    }
}

