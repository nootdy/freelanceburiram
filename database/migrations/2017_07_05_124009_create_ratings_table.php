<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id'); //จาก post_jobs
            $table->integer('rate_e')->nullable();
            $table->integer('rate_f')->nullable();
            $table->tinyInteger('status_rate_e')->nullable()->default(0);//1=emp give rate already
            $table->tinyInteger('status_rate_f')->nullable()->default(0);//0=free not give rate yet
            $table->integer('f_id');
            $table->timestamps();
        });
    }
    //หลักคือ จาก post_id นี้ emp ให้ดาวเท่าไรต่อฟรีแลนซ และฟรีแลนซ์ให้ดาวเท่าไรต่อ emp
    //ให้มี status เพราะเอาไว้เรียกข้อมูล เช่น แสดงรายชื่อผู้ว่าจ้างที่ยังไม่ให้เรท เมื่อเข้าสู่ระบบเป็นฟรีแลนซ์
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ratings');
    }
}
