<?php

namespace App;

use App\Post_Job_Detail;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable=['id','name'];

    public function job_details()
    {
      return $this->hasMany('App\Post_Job_Detail', 'job_category');
    }
    public function categories()
    {
      return $this->belongsTo('App\Category','id');
    }
    public function users()
    {
      return $this->belongsToMany('App\User','id');
    }
}
