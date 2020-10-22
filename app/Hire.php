<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\User;
use App\Post_Job;
use App\Post_Job_Detail;

use Illuminate\Database\Eloquent\Model;
// use Elasticquent\ElasticquentTrait;

class Hire extends Model
{
    // use ElasticquentTrait;
    protected $table = 'hires';
    protected  $fillable = ['id','emp_id','f_id','created_at','updated_at'];

}
