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
                'href'                  => 'admin-section-menu',
                'menu_routes'           => [
                    [
                        'model'         => 'App\Models\AdminMenu',
                        'model_id'      => 1,
                        'name'          => 'admin-section-menu',
                        'url'           => '/admin-section-menu/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,index',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-section-menu-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-section-menu.get-data-table-serverside',
                        'url'           => '/admin-section-menu/get-data-table-serverside',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,getDataTableServerside',
                        'type'          => 'get',
                        'is_ajax'       => 'yes',
                        'permissions'   => ['admin-section-menu-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-section-menu.store',
                        'url'           => '/admin-section-menu/store/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,store',
                        'type'          => 'post',
                        'is_ajax'        => 'yes',
                        'permissions'   => ['admin-section-menu-list', 'admin-section-menu-create']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-section-menu.edit-show',
                        'url'           => '/admin-section-menu/edit/{adminMenuSectionId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,show',
                        'type'          => 'get',
                        'is_ajax'        => 'yes',
                        'permissions'   => ['admin-section-menu-list', 'admin-section-menu-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-section-menu.edit',
                        'url'           => '/admin-section-menu/edit/{adminMenuSectionId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,update',
                        'type'          => 'post',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-section-menu-list', 'admin-section-menu-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-section-menu.delete',
                        'url'           => '/admin-section-menu/delete/{adminMenuSectionId}/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminSectionMenuController,delete',
                        'type'          => 'delete',
                        'is_ajax'        => 'yes',
                        'permissions'   => ['admin-section-menu-list', 'admin-section-menu-delete']
                    ]
                ]
            ],
            [
                'admin_section_menu_id' => 2,
                'name'                  => 'Admin Menu',
                'icon'                  => 'fas fa-window-restore',
                'href'                  => 'admin-menu',
                'menu_routes'           => [
                    [
                        'model'         => 'App\Models\AdminMenu',
                        'model_id'      => 2,
                        'name'          => 'admin-menu',
                        'url'           => '/admin-menu/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,index',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-menu-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.get-data-table-serverside',
                        'url'           => '/admin-menu/get-data-table-serverside',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,getDataTableServerside',
                        'type'          => 'get',
                        'is_ajax'       => 'yes',
                        'permissions'   => ['admin-menu-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.create',
                        'url'           => '/admin-menu/create/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,create',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-menu-list', 'admin-menu-create']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.edit',
                        'url'           => '/admin-menu/edit/{adminMenuId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,show',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-menu-list', 'admin-menu-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.store',
                        'url'           => '/admin-menu/store/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,store',
                        'type'          => 'post',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-menu-list', 'admin-menu-create']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.update',
                        'url'           => '/admin-menu/update/{adminMenuId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,update',
                        'type'          => 'post',
                        'is_ajax'       => 'no',
                        'permissions'   => ['admin-menu-list', 'admin-menu-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'admin-menu.delete',
                        'url'           => '/admin-menu/delete/{adminMenuId}/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\AdminMenuController,delete',
                        'type'          => 'delete',
                        'is_ajax'        => 'yes',
                        'permissions'   => ['admin-menu-list', 'admin-menu-delete']
                    ]
                ]
            ],
            [
                'admin_section_menu_id' => 2,
                'name'                  => 'Role Management',
                'icon'                  => 'fas fa-user-tag',
                'href'                  => 'role-management',
                'menu_routes'           => [
                    [
                        'model'         => 'App\Models\AdminMenu',
                        'model_id'      => 3,
                        'name'          => 'role-management',
                        'url'           => '/role-management/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,index',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['role-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.get-data-table-serverside',
                        'url'           => '/role-management/get-data-table-serverside',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,getDataTableServerside',
                        'type'          => 'get',
                        'is_ajax'       => 'yes',
                        'permissions'   => ['role-list']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.create',
                        'url'           => '/role-management/create/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,create',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['role-list', 'role-create']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.edit',
                        'url'           => '/role-management/edit/{roleId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,show',
                        'type'          => 'get',
                        'is_ajax'       => 'no',
                        'permissions'   => ['role-list', 'role-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.create',
                        'url'           => '/role-management/create/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,store',
                        'type'          => 'post',
                        'is_ajax'       => 'no',
                        'permissions'   => ['role-list', 'role-create']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.edit',
                        'url'           => '/role-management/edit/{roleId}',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,update',
                        'type'          => 'post',
                        'is_ajax'       => 'no',
                        'permissions'   => ['role-list', 'role-edit']
                    ],
                    [
                        'model'         => null,
                        'model_id'      => null,
                        'name'          => 'role-management.delete',
                        'url'           => '/role-management/delete/{roleId}/',
                        'parameter'     => 'App\Http\Controllers\Dashboard\RoleManagementController,delete',
                        'type'          => 'delete',
                        'is_ajax'       => 'yes',
                        'permissions'   => ['role-list', 'role-delete']
                    ],
                ]
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
        $data_menu_routes = [

        ];
        foreach($admin_section_menus as $admin_section_menu){
            AdminSectionMenu::create($admin_section_menu);
        }

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($admin_menus as $admin_menu) {
            $admenu = AdminMenu::create([
                'admin_section_menu_id' => $admin_menu['admin_section_menu_id'],
                'name'                  => $admin_menu['name'],
                'icon'                  => $admin_menu['icon'],
                'href'                  => $admin_menu['href'],
            ]);

            foreach ($admin_menu['menu_routes'] as $menu_route) {
                $men_route = MenuRoute::create([
                    'admin_menu_id' => $admenu->id,
                    'model'         => $menu_route['model'],
                    'model_id'      => $menu_route['model_id'],
                    'name'          => $menu_route['name'],
                    'url'           => $menu_route['url'],
                    'parameter'     => $menu_route['parameter'],
                    'type'          => $menu_route['type'],
                    'is_ajax'       => $menu_route['is_ajax'],
                ]);
                foreach ($menu_route['permissions'] as $permission) {
                    $permi = Permission::findByName($permission);
                    $menuRouteHasPermission = new MenuRouteHasPermission;
                    $menuRouteHasPermission->permission_id = $permi->id;
                    $menuRouteHasPermission->menu_route_id = $men_route->id;
                    $menuRouteHasPermission->save();
                }
                // $men_route->givePermissionTo($menu_route['permissions']);
            }
        }

        // $counter = 0;
        // $hingga  = 4;
        // foreach ($admin_menus as $admin_menu) {
        //     $admenu = AdminMenu::create($admin_menu);
        //     for ($i=$counter; $i < $hingga; $i++) {
        //         $permi =
        //         $menu_routes = [
        //             'admin_menu_id' => $admenu->id,
        //             'model'         => $data_menu_routes[$i]['model'],
        //             'model_id'      => $data_menu_routes[$i]['model_id'],
        //             'permission_id' => $permi->id,
        //             'name'          => $data_menu_routes[$i]['name'],
        //             'url'           => $data_menu_routes[$i]['url'],
        //             'parameter'     => $data_menu_routes[$i]['parameter'],
        //             'type'          => $data_menu_routes[$i]['type'],
        //         ];
        //         MenuRoute::create($menu_routes);
        //     }
        //     $counter=$counter+4;
        //     $hingga=$hingga+4;
        // }

        // foreach ($menu_routes_has_permissions as $menu_routes_has_permission) {
        //     $menuRouteHasPermission = create MenuRouteHasPermission;
        //     $menuRouteHasPermission->permission_id = $menu_routes_has_permission['permission_id'];
        //     $menuRouteHasPermission->menu_route_id = $menu_routes_has_permission['menu_route_id'];
        //     $menuRouteHasPermission->timestamps = false;
        //     $menuRouteHasPermission->save();
        // }
    }
}
