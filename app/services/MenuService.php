<?php

namespace App\services;

use App\Repositories\IMenuRepository;
use Illuminate\Support\Facades\DB;

class MenuService
{
    protected $menuRepository;

    /**
     * Konstruktor untuk dependency injection MenuRepository
     *
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(IMenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * Mendapatkan menu yang dapat diakses berdasarkan user ID
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getAccessibleMenus(int $userId)
    {
        return $this->menuRepository->getAccessibleMenus($userId);
    }
}
