<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    protected $fillable = [
        'name', 'icon', 'url', 'description', 'is_enabled'
    ];

    // Relasi many-to-many dengan Permission melalui pivot table 'menu_permissions'
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permissions', 'menu_id', 'permission_id');
    }
}

