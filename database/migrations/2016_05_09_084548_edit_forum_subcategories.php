<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditForumSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_subcategories', function(Blueprint $table){
           $table->boolean('is_locked')->default(false) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_subcategories', function(Blueprint $table){
            $table->dropColumn('is_locked');
        });
    }
}
