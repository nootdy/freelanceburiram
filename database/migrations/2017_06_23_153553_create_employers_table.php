<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('employers', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email')->unique();
        $table->char('pid',13);
        $table->char('gender',1);
        $table->text('address');
        $table->string('tel',10);
        $table->string('pic_path',200);
        $table->text('comp_name');
        $table->text('comp_address');
        $table->text('comp_tel',20);
        $table->text('comp_tax_id',13); //เลขผู้เสียภาษี 13 หลัก
        $table->text('comp_permis',13); //เลขทะเบียนพาณิชย์ 13 หลัก
        $table->boolean('status');
        $table->string('ref_pic_path',200);
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
        Schema::drop('employers');
    }
}
