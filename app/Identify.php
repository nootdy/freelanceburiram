<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identify extends Model
{
    protected $table = 'identifies';
    protected $fillable = ['id','i_user_id','i_pic_path','status','status_created','created_at','updated_at'];

}
