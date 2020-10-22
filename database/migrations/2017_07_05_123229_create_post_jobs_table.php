<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('job_category', 255);
            $table->string('position', 255);
            $table->integer('payment');
            $table->text('job_description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('slug');
            $table->integer('user_id'); //จาก users
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
        Schema::drop('post_jobs');
    }
}
