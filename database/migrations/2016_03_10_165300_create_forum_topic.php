<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTopic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topic', function(Blueprint $table){
            $table->increments('id');
            $table->string('subject');
            $table->boolean('is_opened')->default(true);
            $table->integer('user_id')->unsigned()->index();
            $table->integer('forum_subcategory_id')->unsigned()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_topic');
    }
}
