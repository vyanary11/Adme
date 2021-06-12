<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $admin_menu_id
 * @property string $name
 * @property string $href
 * @property AdminMenu $adminMenu
 */
class AdminSubMenu extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['admin_menu_id', 'name', 'href'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminMenu()
    {
        return $this->belongsTo('App\Models\AdminMenu');
    }

    public function menuses()
    {
        return $this->morphMany('App\Models\MenuRoute', 'menu_or_submenu','model','model_id');
    }
}
