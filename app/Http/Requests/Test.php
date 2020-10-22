<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Test extends FormRequest
{
  public function rules(){
             return [
               'email' => 'required',
               'password' => 'required'
              ];
        }
}
