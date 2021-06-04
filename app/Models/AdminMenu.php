<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AdminMenu extends Model
{
    use HasFactory;

    public function admin_section_menu()
    {
        return $this->hasOne(AdminSectionMenu::class);
    }

    public function menus()
    {
        return $this->morphMany(MenuRoute::class, 'menu_or_submenu','model','model_id');
    }

    public function menu_routes()
    {
        return $this->hasMany(MenuRoute::class);
    }

    public function admin_sub_menus()
    {
        return $this->hasMany(AdminSubMenu::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }
}


