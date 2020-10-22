<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Freelance extends Model
{
    use ElasticquentTrait;
    protected $table = 'freelances';
    protected $fillable = ['pid','gender','address','tel','work_place','job_skills','personal_skills'];

    public function users()
    {
      return $this->belongsTo('App\User','id');
    }
}
