<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RegisterFormRequest;

use App\User;
use App\Freelance;
use App\Employer;
use App\Role;

class RegisterController extends Controller
{
    //Register Freelance
    public function getFreelanceRegisterPage()
    {
        return view('auth.freelanceregister');
    }

    public function postFreelanceRegister(RegisterFormRequest $request)
    {

      $user = new User();
      $user->first_name = $request['first_name'];
      $user->last_name = $request['last_name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->save();
      $user->roles()->attach(Role::where('name', 'Freelance')->first());
      Auth::login($user);

      $user = new Freelance();
      $user->email = $request['email'];
      $user->pid = $request['pid'];
      $user->gender = $request['gender'];
      $user->address = $request['address'];
      $user->tel = $request['tel'];
      $user->pic_path = $request['pic_path'];
      $user->work_place = $request['work_place'];
      $user->job_skills = $request['job_skills'];
      $user->personal_skills = $request['personal_skills'];
      $user->ref_pic_path = $request['ref_pic_path'];

      $user->save();
      // return redirect('/freelanceregister')->with('status', 'ลงทะเบียนฟรีแลนซ์สำเร็จ');
      return redirect()->route('main');
    }



    public function getEmployerRegisterPage()
    {
        return view('auth.employerregister');
    }

    public function postEmployerRegister(Request $request)
    {
      $user = new User();
      $user->first_name = $request['first_name'];
      $user->last_name = $request['last_name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->save();
      $user->roles()->attach(Role::where('name', 'Employer')->first());
      Auth::login($user);

      $user = new employer();
      $user->email = $request['email'];
      $user->pid = $request['pid'];
      $user->gender = $request['gender'];
      $user->address = $request['address'];
      $user->tel = $request['tel'];
      $user->pic_path = $request['pic_path'];
      $user->work_place = $request['comp_name'];
      $user->job_skills = $request['comp_address'];
      $user->personal_skills = $request['comp_tel'];
      $user->ref_pic_path = $request['comp_tax_id'];
      $user->ref_pic_path = $request['comp_permis'];
      $user->ref_pic_path = $request['status'];
      $user->ref_pic_path = $request['ref_pic_path'];

      $user->save();

      return redirect()->route('main');
    }
}
