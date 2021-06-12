<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $admin_section_menu_id
 * @property string $name
 * @property string $icon
 * @property string $href
 * @property AdminSectionMenu $adminSectionMenu
 * @property AdminSubMenu[] $adminSubMenuses
 * @property MenuRoute[] $menuRoutes
 */
class AdminMenu extends Model
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
    protected $fillable = ['admin_section_menu_id', 'name', 'icon', 'href'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminSectionMenu()
    {
        return $this->belongsTo('App\Models\AdminSectionMenu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminSubMenuses()
    {
        return $this->hasMany('App\Models\AdminSubMenu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuRoutes()
    {
        return $this->hasMany('App\Models\MenuRoute');
    }

    public function menuses()
    {
        return $this->morphMany('App\Models\MenuRoute', 'menu_or_submenu','model','model_id');
    }
}
