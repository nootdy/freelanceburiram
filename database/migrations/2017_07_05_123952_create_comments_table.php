<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content'); //เนื้อหาคอมเมนต์
            $table->integer('post_id');
            $table->integer('user_id');
            $table->tinyInteger('status')->default(0);//0=ส่งความเห็นไม่ได้ 1=ส่งความเห็นได้
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
        Schema::drop('comments');
    }
}
