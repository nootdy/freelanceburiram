<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['job_slug','job_detail_id','reviewed','reviewer','rate','comment','created_at','updated_at'];

    public function users()
    {
      return $this->belongsTo('App\User'); //model , FK key
    }
}
