<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $permission_id
 * @property integer $menu_route_id
 * @property MenuRoute $menuRoute
 * @property Permission $permission
 */
class MenuRouteHasPermission extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['permission_id','menu_route_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuRoute()
    {
        return $this->belongsTo('App\Models\MenuRoute');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('Spatie\Permission\Models\Permission');
    }
}
