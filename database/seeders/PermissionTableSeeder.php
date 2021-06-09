<?php

namespace Database\Seeders;

use App\Models\AdminMenu;
use App\Models\AdminSectionMenu;
use App\Models\MenuRoute;
use App\Models\MenuRouteHasPermission;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_menus = [
            [
                'admin_section_menu_id' => 2,
                'name'                  => 'Admin Section Menu',
                'icon'                  => 'fas fa-window-minimize',
                'href'                  => 'admin-section-menu'
            ],
            [
                'admin_section_menu_id' => 2,
                'name'                  => 'Admin Menu',
                'icon'                  => 'fas fa-window-restore',
                'href'                  => 'admin-menu'
            ],
            [
                'admin_section_menu_id' => 2,
                'name'                  => 'Role Management',
                'icon'                  => 'fas fa-user-tag',
                'href'                  => 'role-management'
            ]
        ];
        $admin_section_menus = [
            [
                'name'  => 'Featured'
            ],
            [
                'name'  => 'Master'
            ]
        ];
        $permissions = [
            'admin-section-menu-list',
            'admin-section-menu-create',
            'admin-section-menu-edit',
            'admin-section-menu-delete',
            'admin-menu-list',
            'admin-menu-create',
            'admin-menu-edit',
            'admin-menu-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];
        $menu_routes_has_permissions = [
            [
                'permission_id' => 1,
                'menu_route_id' => 1
            ],
            [
                'permission_id' => 1,
                'menu_route_id' => 2
            ],
            [
                'permission_id' => 2,
                'menu_route_id' => 2
            ],
            [
                'permission_id' => 1,
                'menu_route_id' => 3
            ],
            [
                'permission_id' => 3,
                'menu_route_id' => 3
            ],
            [
                'permission_id' => 1,
                'menu_route_id' => 4
            ],
            [
                'permission_id' => 4,
                'menu_route_id' => 4
            ],
            [
                'permission_id' => 5,
                'menu_route_id' => 5
            ],
            [
                'permission_id' => 5,
                'menu_route_id' => 6
            ],
            [
                'permission_id' => 6,
                'menu_route_id' => 6
            ],
            [
                'permission_id' => 5,
                'menu_route_id' => 7
            ],
            [
                'permission_id' => 7,
                'menu_route_id' => 7
            ],
            [
                'permission_id' => 5,
                'menu_route_id' => 8
            ],
            [
                'permission_id' => 8,
                'menu_route_id' => 8
            ],
            [
                'permission_id' => 9,
                'menu_route_id' => 9
            ],
            [
                'permission_id' => 9,
                'menu_route_id' => 10
            ],
            [
                'permission_id' => 10,
                'menu_route_id' => 10
            ],
            [
                'permission_id' => 9,
                'menu_route_id' => 11
            ],
            [
                'permission_id' => 11,
                'menu_route_id' => 11
            ],
            [
                'permission_id' => 9,
                'menu_route_id' => 12
            ],
            [
                'permission_id' => 12,
                'menu_route_id' => 12
            ]

        ];
        $data_menu_routes = [
            [
                'model'         => 'App\Models\AdminMenu',
                'model_id'      => 1,
                'name'          => 'admin-section-menu',
                'url'           => '/admin/admin-section-menu/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,index',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => null,
                'url'           => '/admin/admin-section-menu/new/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,save',
                'type'          => 'get',
                'is_ajax'        => 'yes',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => null,
                'url'           => '/admin/admin-section-menu/edit/{adminMenuSectionId}',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,update',
                'type'          => 'post',
                'is_ajax'        => 'yes',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => null,
                'url'           => '/admin/admin-section-menu/delete/{adminMenuSectionId}/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,delete',
                'type'          => 'delete',
                'is_ajax'        => 'yes',
            ],
            [
                'model'         => 'App\Models\AdminMenu',
                'model_id'      => 2,
                'name'          => 'admin-menu',
                'url'           => '/admin/admin-menu/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,index',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => 'admin-menu.new',
                'url'           => '/admin/admin-menu/new/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,form',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => 'admin-menu.edit',
                'url'           => '/admin/admin-menu/edit/{adminMenuId}',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,form',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => null,
                'url'           => '/admin/admin-menu/delete/{adminMenuId}/',
                'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,delete',
                'type'          => 'delete',
                'is_ajax'        => 'yes',
            ],
            [
                'model'         => 'App\Models\AdminMenu',
                'model_id'      => 3,
                'name'          => 'role-management',
                'url'           => '/admin/role-management/',
                'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,index',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => 'role-management.new',
                'url'           => '/admin/role-management/new/',
                'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,form',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => 'role-management.edit',
                'url'           => '/admin/role-management/edit/{roleId}',
                'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,form',
                'type'          => 'get',
            ],
            [
                'model'         => null,
                'model_id'      => null,
                'name'          => null,
                'url'           => '/admin/role-management/delete/{roleId}/',
                'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,delete',
                'type'          => 'delete',
                'is_ajax'       => 'yes',
            ],
        ];
        foreach($admin_section_menus as $admin_section_menu){
            AdminSectionMenu::create($admin_section_menu);
        }

        $counter = 0;
        $hingga  = 4;
        foreach ($admin_menus as $admin_menu) {
            $admenu = AdminMenu::create($admin_menu);
            for ($i=$counter; $i < $hingga; $i++) {
                $permi = Permission::create(['name' => $permissions[$i]]);
                $menu_routes = [
                    'admin_menu_id' => $admenu->id,
                    'model'         => $data_menu_routes[$i]['model'],
                    'model_id'      => $data_menu_routes[$i]['model_id'],
                    'permission_id' => $permi->id,
                    'name'          => $data_menu_routes[$i]['name'],
                    'url'           => $data_menu_routes[$i]['url'],
                    'parameter'     => $data_menu_routes[$i]['parameter'],
                    'type'          => $data_menu_routes[$i]['type'],
                ];
                MenuRoute::create($menu_routes);
            }
            $counter=$counter+4;
            $hingga=$hingga+4;
        }

        foreach ($menu_routes_has_permissions as $menu_routes_has_permission) {
            $menuRouteHasPermission = new MenuRouteHasPermission;
            $menuRouteHasPermission->permission_id = $menu_routes_has_permission['permission_id'];
            $menuRouteHasPermission->menu_route_id = $menu_routes_has_permission['menu_route_id'];
            $menuRouteHasPermission->timestamps = false;
            $menuRouteHasPermission->save();
        }
    }
}
