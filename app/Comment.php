<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = ['id'];

    public function postjob()
    {
      return $this->belongsTo('App\Post_Job');
    }
}
