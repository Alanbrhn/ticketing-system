<?php

namespace App\Repositories;


use App\Models\Menu;
use App\Repositories\IMenuRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MenuRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements IMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAccessibleMenus(int $userId)
    {
        return $this->model
            ->join('menu_permissions', 'menus.id', '=', 'menu_permissions.menu_id')
            ->join('role_has_permissions', 'menu_permissions.permission_id', '=', 'role_has_permissions.permission_id')
            ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
            ->leftJoin('icons', 'menus.icon', '=', 'icons.IconName') 
            ->where('model_has_roles.model_id', $userId)
            ->where('menus.is_active', 1) 
            ->distinct()
            ->select('menus.*', 'icons.FilePath') 
            ->get()
            ->map(function ($menu) {
                return (object) $menu;
            });
    }
    
}
