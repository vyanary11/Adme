<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $admin_menu_id
 * @property string $model
 * @property integer $model_id
 * @property string $name
 * @property string $url
 * @property string $parameter
 * @property string $type
 * @property string $is_ajax
 * @property AdminMenu $adminMenu
 * @property Permission[] $permissions
 */
class MenuRoute extends Model
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
    protected $fillable = ['admin_menu_id', 'model', 'model_id', 'name', 'url', 'parameter', 'type', 'is_ajax'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminMenu()
    {
        return $this->belongsTo('App\Models\AdminMenu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\MenuRouteHasPermission');
    }

    public function menuORSubmenu()
    {
        return $this->morphTo('menu_or_submenu','model','model_id');
    }
}
