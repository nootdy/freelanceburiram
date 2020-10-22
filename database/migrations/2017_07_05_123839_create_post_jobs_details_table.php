<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostJobsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id'); //จาก post_jobs
            $table->integer('f_id');
            $table->tinyInteger('e_status')->default(0); //สถานะตอบรับ คำขอสมัครงาน โดยผู้ว่าจ้าง
            $table->tinyInteger('f_status')->default(0); //สถานะตอบรับการ คำขอจ้างงาน โดยฟรีแลนซ์
            $table->tinyInteger('status')->default(0); //สถานะที่ทั้งคู่ตกลง
            $table->timestamps();
        });
    }
    //*(e_status)->0 = not hire 1 = hire            #employers
    //*(f_status)->0 = not intrest 1 = intrest      #freelances
    //*(status)->0 = ยังไม่ตกลงจ้าง 1 = เกิดการจ้างงาน      #employers #freelances
    //ถ้าเกิดการจ้างงานเราก็จะสามารถให้เรทติ้งได้

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_jobs_details');
    }
}
