<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model //set role for users
{
  protected $fillable = ['name'];

    public function users()
    {
      return $this->belongsToMany('App\User');
      // return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }
}
