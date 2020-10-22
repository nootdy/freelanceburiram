<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Employer;
use App\Contact;
use App\Post_Job_Detail;


class Post_Job extends Model
{

    protected $fillable = ['id','title','slug','user_id','created_at'];
    protected $table = 'post_jobs';


    private function buildFieldsParameter($getSourceIfPossible, $getTimestampIfPossible) { return null; }

    public function users()
    {
      return $this->belongsTo('App\User','user_id');
    }
    public function employers()
    {
      return Employer::where('user_id',$this->user_id)->orderBy('id', 'desc')->first();
      // return $this->belongsTo('App\Employer','id');
    }
    public function comments()
    {
      return $this->hasMany('App\Comment', 'post_id' , 'content' , 'status');
    }
    public function post_jobs_details()
    {
      return $this->hasMany('App\Post_Job_Detail' , 'post_id'); //ใช้ใน jobsboard ที่ map
    }
    public function reviews() //review system
    {
      return $this->hasMany('App\Review', 'job_slug');
    }
    public function contacts() //contact system
    {
      return $this->hasMany('App\Contact', 'slug_id');
    }


}
