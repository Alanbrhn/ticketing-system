<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MenuPermission extends Pivot
{
    // Model pivot tidak membutuhkan banyak pengaturan
    protected $table = 'menu_permissions';
}