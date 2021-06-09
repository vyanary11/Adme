<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration  {
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up(){
        $tableNames = config('permission.table_names');
        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->morphs('model');
            $table->foreign('permission_id')
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames) {
            $table->integer('role_id')->unsigned();
            $table->morphs('model');
            $table->foreign('role_id')
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');
            $table->foreign('role_id')
            ->references('id')
            ->on($tableNames['roles'])
            ->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('menu_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_menu_id');
            $table->string('model')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedInteger('permission_id');
            $table->string('name')->nullable();
            $table->text('url');
            $table->text('parameter');
            $table->enum('type',['view','get','post','delete','put']);
            $table->enum('is_ajax',['yes','no'])->default('no');
            $table->timestamps();
            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions')
            ->onDelete('cascade');
        });

        Schema::create('menu_route_has_permissions', function (Blueprint $table) use ($tableNames) {
            $table->integer('permission_id')->unsigned();
            $table->bigInteger('menu_route_id')->unsigned();
            $table->foreign('permission_id')
            ->references('id')
            ->on($tableNames['permissions'])
            ->onDelete('cascade');
            $table->foreign('menu_route_id')
            ->references('id')
            ->on('menu_routes')
            ->onDelete('cascade');
            $table->primary(['permission_id', 'menu_route_id']);
            app('cache')->forget('spatie.permission.cache');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down(){
        $tableNames = config('permission.table_names');
        Schema::drop('menu_route_has_permissions');
        Schema::drop('menu_routes');
        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);

    }
}
