<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post_Job_Detail;
use App\Post_Job;


class Contact extends Model
{
  protected $table = 'contact';
  protected $fillable = ['id','slug_id','job_detail_id','f_id','status','f_review_status','e_review_status'];

  public function post_jobs_details() //สร้างไว้ก่อนยังไม่ใช้
  {
    return $this->hasMany('App\Post_Job_Detail' , 'id');
  }

  public function post_job() {
    return $this->belongsTo('App\Post_Job', 'slug');
  }

}
