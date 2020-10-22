<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post_Job;
use App\Category;
use App\Contact;


class Post_Job_Detail extends Model
{


  protected $fillable = ['post_id','position','amount','min_pay','max_pay','start_date','end_date','job_category','job_description'];
  protected $table = 'post_jobs_details';

  private function buildFieldsParameter($getSourceIfPossible, $getTimestampIfPossible) { return null; }


  public function job() {
    return $this->belongsTo('App\Post_Job', 'post_id');
  }

  public function category()
  {
    return $this->hasMany('App\Category', 'id');
  }

  public function contact() //สร้างไว้ก่อนยังไม่ใช้
  {
    return $this->hasMany('App\Contact','job_detail_id');
  }


}
