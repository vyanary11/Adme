<?php

use App\Http\Controllers\Dashboard\HomeController as Dashboard;
use App\Models\MenuRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Route::get('/', function(){
    return redirect(route('dashboard'));
});
Route::group([ "middleware" => ['auth'] ], function() {
    Route::get('/dashboard', [Dashboard::class, "index"])->name('dashboard');
    foreach (MenuRoute::with("permission","permission.permission")->get() as $menu_route) {
        $middleware=[];
        $permissions=null;
        foreach ($menu_route->permission as $has_permission) {
            if ($permissions==null) {
                $permissions='permission:'.$has_permission->permission->name;
            }else{
                $permissions = $permissions."|".$has_permission->permission->name;
            }
        }
        if ($permissions!=null) {
            array_push($middleware, $permissions);
        }
        // dd(explode(",", $menu_route->parameter));
        if($menu_route->type=="get"){
            if($menu_route->name!=null){
                Route::get($menu_route->url, explode(",", $menu_route->parameter))->name($menu_route->name)->middleware([$permissions]);
            }else{
                Route::get($menu_route->url, explode(",", $menu_route->parameter))->middleware([$permissions]);
            }
        }elseif($menu_route->type=="post"){
            if($menu_route->name!=null){
                Route::post($menu_route->url, explode(",", $menu_route->parameter))->name($menu_route->name)->middleware([$permissions]);
            }else{
                Route::post($menu_route->url, explode(",", $menu_route->parameter))->middleware([$permissions]);
            }
        }elseif($menu_route->type=="put"){
            if($menu_route->name!=null){
                Route::put($menu_route->url, explode(",", $menu_route->parameter))->name($menu_route->name)->middleware([$permissions]);
            }else{
                Route::put($menu_route->url, explode(",", $menu_route->parameter))->middleware([$permissions]);
            }
        }elseif($menu_route->type=="delete"){
            if($menu_route->name!=null){
                Route::put($menu_route->url, explode(",", $menu_route->parameter))->name($menu_route->name)->middleware([$permissions]);
            }else{
                Route::put($menu_route->url, explode(",", $menu_route->parameter))->middleware([$permissions]);
            }
        }elseif ($menu_route->type=="view") {
            if($menu_route->name!=null){
                Route::view($menu_route->url, $menu_route->parameter)->name($menu_route->name)->middleware([$permissions]);
            }else{
                Route::view($menu_route->url, $menu_route->parameter)->middleware([$permissions]);
            }

        }
    }

    Route::view('/admin/user/profile', "admin.profile.show")->name('profile');
});
