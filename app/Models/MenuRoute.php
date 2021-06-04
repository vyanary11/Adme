<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRoute extends Model
{
    use HasFactory;

    public function permission()
    {
        return $this->hasMany(MenuRouteHasPermission::class);
    }

    public function menu_or_submenu()
    {
        return $this->morphTo('menu_or_submenu','model','model_id');
    }
}
