<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MenuRepositoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface IMenuRepository extends RepositoryInterface
{
    public function getAccessibleMenus(int $userId);
}
