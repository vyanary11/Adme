<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSubMenu extends Model
{
    use HasFactory;

    public function menus()
    {
        return $this->morphMany(MenuRoute::class, 'menu_or_submenu','model','model_id');
    }

    public function admin_menu()
    {
        return $this->hasOne(AdminMenu::class);
    }
}
