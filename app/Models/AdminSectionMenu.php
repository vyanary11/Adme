<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property AdminMenu[] $adminMenuses
 */
class AdminSectionMenu extends Model
{
    public $timestamps = false;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminMenuses()
    {
        return $this->hasMany('App\Models\AdminMenu');
    }

    public static function getAdminMenuses($permission_id)
    {
        return static::select('admin_section_menus.id','admin_section_menus.name')
                ->leftJoin('admin_menus','admin_menus.admin_section_menu_id','admin_section_menus.id')
                ->leftJoin('menu_routes','menu_routes.admin_menu_id','admin_menus.id')
                ->leftJoin('menu_route_has_permissions','menu_route_has_permissions.menu_route_id','menu_routes.id')
                ->whereIn('menu_route_has_permissions.permission_id', $permission_id)
                ->where('menu_routes.model','!=',null)
                ->with(['adminMenuses' => function($admin_menus) use ($permission_id){
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
}
