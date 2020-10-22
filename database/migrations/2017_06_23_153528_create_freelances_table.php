<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('freelances', function (Blueprint $table) {
          $table->increments('id');
          $table->string('email')->unique();
          $table->char('pid',13);
          $table->char('gender',1);
          $table->text('address');
          $table->string('tel',10);
          $table->string('pic_path',200)->nullable();
          $table->text('work_place');
          $table->text('job_skills');
          $table->text('personal_skills');
          $table->string('ref_pic_path',200)->nullable();
          $table->double('avg_rating')->nullable(); //add later
          $table->rememberToken();
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
        Schema::drop('freelances');
    }
}
