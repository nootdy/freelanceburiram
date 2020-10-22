<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

// use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Validator;
use App\Post_Job;
use App\Category;

// use Elasticquent\ElasticquentTrait;
class User extends Authenticatable
{
  // use ElasticquentTrait;
  protected $table = 'users';
  protected $fillable = [];
  private function buildFieldsParameter($getSourceIfPossible, $getTimestampIfPossible) { return null; }

    public function roles()
    {
      return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function isFreelance()
    {
      foreach ($this->roles()->get() as $role)
      {
        if ($role->name == 'Freelance')
        {
            return true;
        }
      }
    }

    public function isEmployer()
    {
      foreach ($this->roles()->get() as $role)
      {
        if ($role->name == 'Employer')
        {
            return true;
        }
      }
    }

    public function isAdmin()
    {
      foreach ($this->roles()->get() as $role)
      {
        if ($role->name == 'Admin')
        {
            return true;
        }
      }
    }

    public function hasAnyRole($roles) // find out that do they have a role?
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      }
      else {
        if ($this->hasRole($roles)) {
            return true;
        }
      }
      return false;
    }

    public function hasRole($role)
    {
      if ($this->roles()->where('name',$role)->first()) {
        return true;
      }
      return false;
    }
    public function reviews()
    {
      return $this->hasMany('App\Review', 'reviewed', 'reviewer');
    }
    public function categories()
    {
      return $this->belongsToMany('App\Category', 'id');
    }

}
