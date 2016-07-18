<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_categories', function (Blueprint $table) {
            $table->integer('order')->unsigned();
        });
        Schema::table('forum_subcategories', function (Blueprint $table) {
            $table->integer('order')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_categories', function (Blueprint $table) {
            $table->dropColumn('order');
        });
        Schema::table('forum_subcategories', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
