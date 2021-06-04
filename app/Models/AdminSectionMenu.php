<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSectionMenu extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function admin_menus()
    {
        return $this->hasMany(AdminMenu::class);
    }

    public static function get_admin_menus($permission_id)
    {
        return static::select('admin_section_menus.id','admin_section_menus.name')
                ->leftJoin('admin_menus','admin_menus.admin_section_menu_id','admin_section_menus.id')
                ->leftJoin('menu_routes','menu_routes.admin_menu_id','admin_menus.id')
                ->leftJoin('menu_route_has_permissions','menu_route_has_permissions.menu_route_id','menu_routes.id')
                ->whereIn('menu_route_has_permissions.permission_id', $permission_id)
                ->where('menu_routes.model','!=',null)
                ->with(['admin_menus' => function($admin_menus) use ($permission_id){
                    return $admin_menus->select('admin_menus.*')
                        ->leftJoin('menu_routes','menu_routes.admin_menu_id','admin_menus.id')
                        ->leftJoin('menu_route_has_permissions','menu_route_has_permissions.menu_route_id','menu_routes.id')
                        ->whereIn('menu_route_has_permissions.permission_id', $permission_id)
                        ->where('menu_routes.model','!=',null)
                        ->groupBy('admin_menus.id');
                }])
                ->groupBy('admin_section_menus.id')
                ->get();
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }
}
