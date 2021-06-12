<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSubMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_sub_menus', function (Blueprint $table) {
            $table->unsignedBigInteger("admin_menu_id");
            $table->string("name","32");
            $table->text("href")->nullable();
            $table->foreign('admin_menu_id')->references('id')->on('admin_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_sub_menus');
    }
}
