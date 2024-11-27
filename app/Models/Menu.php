<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'url',
        'is_dropdown',
        'parent_id',
        'is_active'
    ];

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('id');
    }

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    // Relasi many-to-many dengan Permission melalui pivot table 'menu_permissions'
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permissions', 'menu_id', 'permission_id');
    }
}

