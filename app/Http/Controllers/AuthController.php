<?php

namespace App\Http\Controllers;

use App\User;
use App\Post_Job;
use App\Post_Job_Detail;
use App\Comment;
use App\Contact;
use App\Review;
use App\Category;
use App\Identify;

use App\Role;
use DB;
use Image;
use File;
use Mail;
use Carbon;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
//-------forgot password--------
  public function getForgot_PasswordPage()
  {
    return view('auth.forgot-password');
  }

  public function postForgot_PasswordPage(Request $request)
  {
    $email = $request->get('email');
    $users = User::where('email',$email)->exists();

    $data = User::where('email',$email)->get();

    if ($users == true) {

      Mail::send('emails.reset_pass',['data' => $data], function($message){
        $message->from('freelanceburiram@gmail.com','เว็บจัดหางานฟรีแลนซ์บุรีรัมย์');
        $message->to('preeyanoot2013@gmail.com')->subject('แจ้งเตือน รีเซ็ตรหัสผ่าน!');
      });

      return redirect(action('AuthController@postForgot_PasswordPage'))->with('status','ระบบได้ทำการส่งอีเมล สำหรับรีเซ็ตรหัสผ่านเรียบร้อยแล้ว');
    }
    else {
      return redirect(action('AuthController@postForgot_PasswordPage'))->with('status1','ไม่มีอีเมลผู้ใช้นี้อยู่ในระบบ กรุณาตรวจสอบใหม่อีกครั้ง');
    }
  }
  //----------Reset Password อันนี้ไม่ใช้แล้ว ------------
//   public function getReset_PasswordPage(Request $request)
//   {
//       $id = $request->get('id');
//       return view('auth.reset-password');
//   }
//
//   public function postReset_PasswordPage(Request $request)
//   {
//     $id = $request->get('id');
//     // dd($id);
//     if ($_POST['password']) {
//       $pass = $request->get('password');
//       $con_pass = $request->get('password_confirmation');
//       // dd($pass);
//
//       if ($pass == $con_pass) {
//         $f_update = ['password'=>bcrypt($request->password)];
//
//         // dd($f_update);
//         DB::table("users")->where('id',$id)->update($f_update);
//         return redirect(action('AuthController@getLoginPage'))->with('status','รหัสผ่านถูกรีเซ็ตใหม่เรียบร้อยแล้ว');
//       }
//       else {
//         return redirect()->back()->with('status1','รหัสผ่านไม่ตรงกัน');
//       }
//     }
//     else {
//       return redirect()->back();
//     }
// }
//----------------------------
  public function getLogout()
  {
    Auth::logout();
    return redirect()->route('main');
  }

  public function getRegisterPage()
  {
    return view('auth.register');
  }

  //Login Form
  public function getLoginPage()
  {
    return view('auth.login');
  }

  public function postLogin(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required'
    ]);
    // $user_id = Auth::id();
    if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
      if (Auth::user()->isAdmin()) { //ถ้าเป็น Admin ให้ไปหน้า แอดมินเลย
        return redirect(action('AuthController@getAdminPage'));
      }
      return redirect()->route('main');
    }

    return redirect()->back();
  }
  //--------------------------------------------------------------------------------//
  public function getAccountPage($id)
  {
    $id = Auth::user()->id;

    $status = Identify::where('i_user_id',$id)->groupBy('i_user_id')->get();
    $check_ident = Identify::where('i_user_id',$id)->exists();


    if (Auth::user()->isEmployer()) {
      $user = User::find($id);
    }
    elseif(Auth::user()->isFreelance()) {
      $fuser = User::find($id);
    }

    //ข้างล่างเอาไว้เรียกข้อมูล รีวิว ของเจ้าของโปรไฟล์
    $get_review = Review::where('reviewed',$id)
    ->join('users','users.id','=','reviewer')
    ->join('post_jobs_details','post_jobs_details.id','=','job_detail_id')
    ->orderBy('reviews.id','desc')
    ->get();
    $count_reviewer = $get_review->count(); //นับผู้มารีวิว
    $rate_avg = Review::where('reviewed',$id)->groupBy('reviewed')->avg('rate'); //ค่าเฉลี่ยเรทติ้ง


    return view('account',compact('user','fuser','id','get_review','count_reviewer','rate_avg','status','check_ident')); //sent data to view

  }
  //--------------------------------------------------------------------------------//
  public function status($slug) //เปิด ปิดงาน
  {
    // $id = Auth::user()->id;
    $job_status =Post_Job::whereSlug($slug)->firstOrFail();

    if ($job_status->status == 0) {
      $job_status->status = '1';
      $job_status->save();
      return redirect()->back()->with('status1','ประกาศหมายเลข :'.$slug.'ได้ถูกปิดเรียบร้อยแล้ว');
    }
    else {
      $job_status->status = '0';
      $job_status->save();
      return redirect()->back()->with('status2','ประกาศหมายเลข :'.$slug.'ได้ถูกเปิดเรียบร้อยแล้ว');
    }
    // dd($job_status);
  }
  //--------------------------------------------------------------------------------//
  public function updateFreelanceAccount(Request $request) //แก้ไขหน้าข้อมูลฟรีแลนซ์
  {

    $id = Auth::user()->id;
    $test = $request->get('f_job_categories');
    // dd($test);
    if ($test == null) { //ถ้าไม่เลือกประเภทงานใหม่ก็เอาค่าเดิม
      $f_update = ['id'=>$request->id
      ,'first_name'=>$request->first_name
      ,'last_name'=>$request->last_name
      ,'f_pid'=>$request->f_pid
      ,'f_gender'=>$request->f_gender
      ,'f_address'=>$request->f_address
      ,'f_tel'=>$request->f_tel
      ,'f_job_skills'=>$request->f_job_skills
      ,'f_personal_skills'=> $request->f_personal_skills];
    }
    else {
      $f_update = ['id'=>$request->id
      ,'first_name'=>$request->first_name
      ,'last_name'=>$request->last_name
      ,'f_pid'=>$request->f_pid
      ,'f_gender'=>$request->f_gender
      ,'f_address'=>$request->f_address
      ,'f_tel'=>$request->f_tel
      ,'f_job_skills'=>$request->f_job_skills
      ,'f_personal_skills'=> $request->f_personal_skills
      ,'f_job_categories' =>serialize($test)];
    }
    // dd($f_update);

    DB::table("users")->where('id',$request->id)->update($f_update);

    $freelanceinfo = DB::table('users')
    ->select('users.first_name','users.last_name','users.f_pid','users.f_gender','users.f_address',
    'users.f_tel','users.f_job_skills','users.f_personal_skills')
    ->where('id',$id)
    ->get();


    if($request->hasFile('avatar')){
      $avatar = $request->file('avatar');
      $filename = time(). '.' . $avatar->getClientOriginalExtension();

      $user = User::find(Auth::user()->id);

      // Delete current image before uploading new image
      if ($user->avatar !== 'avatar.png') {
        $file = public_path('uploads/avatars/' . $user->avatar);

        if (File::exists($file)) {
          unlink($file);
        }

      }

      Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/'. $filename));

      $user =Auth::user();
      $user->avatar = $filename;
      $user->save();
    }
    return redirect(action('AuthController@getAccountPage',$id))->with('status', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
  }
  //--------------------------------------------------------------------------------//
  public function updateEmployerAccount(Request $request) //แก้ไขหน้าข้อมูลผู้ว่าจ้าง
  {
    $id = Auth::user()->id;

    $e_update = ['id'=>$request->id
    ,'first_name'=>$request->first_name
    ,'last_name'=>$request->last_name
    ,'e_pid'=>$request->e_pid
    ,'e_gender'=>$request->e_gender
    ,'e_tel'=>$request->e_tel
    ,'e_comp_name'=>$request->e_comp_name
    ,'e_comp_address'=>$request->e_comp_address
    ,'e_comp_tel'=>$request->e_comp_tel];
    DB::table("users")->where('id',$request->id)->update($e_update);

    $employerinfo = DB::table('users')
    ->select('users.first_name','users.last_name','users.e_pid','users.e_gender',
    'users.e_tel','users.e_comp_name','users.e_comp_tel','users.e_comp_address','users.created_at')
    ->where('id',$id)
    ->get();

    if($request->hasFile('avatar')){
      $avatar = $request->file('avatar');
      $filename = time(). '.' . $avatar->getClientOriginalExtension();

      $user = User::find(Auth::user()->id);

      // Delete current image before uploading new image
      if ($user->avatar !== 'avatar.png') {
        $file = public_path('uploads/avatars/' . $user->avatar);

        if (File::exists($file)) {
          unlink($file);
        }

      }

      Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/'. $filename));

      $user =Auth::user();
      $user->avatar = $filename;
      $user->save();
    }
    return redirect(action('AuthController@getAccountPage',$id))->with('status', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
  }
  //--------------------------------------------------------------------------------//

  public function getFreelanceRegisterPage() //หน้าลงทะเบียนฟรีแลนซ์
  {
    $category = Category::all();
    return view('auth.freelanceregister', compact('category'));
  }

  public function postFreelanceRegister(Request $request) //ลงทะเบียนฟรีแลนซ์ database
  {
    // $all = $request->all();
    // dd($all);

    //NOTE: try validate input
    $this->validate($request, [
      'email' => 'required|email|unique:users',
      'password' => 'required|min:4',
      'password_confirmation' => 'same:password',
      'f_pid' => 'required|size:13',
      'f_tel' => 'required|numeric'
    ]);
    $test = $request->input('f_job_categories');

    //store image to /uploads/avatars
    $avatar = $request->file('avatar');
    $filename = time(). '.' . $avatar->getClientOriginalExtension();
    $file = public_path('uploads/avatars/' . $filename);
    if (File::exists($file)) {
      unlink($file);
    }
    Image::make($avatar)->save(public_path('uploads/avatars/'. $filename));
    //end image



    $user = new User();
    $user->first_name = $request['first_name'];
    $user->last_name = $request['last_name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->avatar = $filename;
    $user->f_pid = $request['f_pid'];
    $user->f_gender = $request['f_gender'];
    $user->f_address = $request['f_address'];
    $user->f_tel = $request['f_tel'];
    $user->f_job_skills = $request['f_job_skills'];
    $user->f_personal_skills = $request['f_personal_skills'];
    $user->f_job_categories = serialize($test);
    $user->save();

    $user->roles()->attach(Role::where('name', 'Freelance')->first());

    Auth::login($user);
    $id = Auth::user()->id;
    // $user->save();

    //ยืนยันตัวตน
    if ($request->hasFile('images'))
    {
      $files = $request->file('images');

      foreach($files as $file)
      {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $picture = date('His').$filename;
        $destinationPath = base_path() . '\public\uploads\identified';
        $file->move($destinationPath, $picture);

        $ident =new Identify; //บันทึกภาพที่อัพโหลด
        $ident->i_user_id = $id;
        $ident->i_pic_path = $picture;
        $ident->save();
      }
    }
    //ยืนยันตัวตน


    return redirect()->route('main');
  }
  //------------------------------------------------------------------------
  //Register Employer
  public function getEmployerRegisterPage()
  {
    return view('auth.employerregister');
  }

  public function postEmployerRegister(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email|unique:users',
      'password' => 'required|min:4',
      'password_confirmation' => 'same:password',
      'e_pid' => 'required|size:13',
      'e_tel' => 'required|numeric'

    ]);

    //store image to /uploads/avatars
    $avatar = $request->file('avatar');
    $filename = time(). '.' . $avatar->getClientOriginalExtension();
    $file = public_path('uploads/avatars/' . $filename);
    if (File::exists($file)) {
      unlink($file);
    }
    Image::make($avatar)->save(public_path('uploads/avatars/'. $filename));
    //end image

    $user = new User();
    $user->first_name = $request['first_name'];
    $user->last_name = $request['last_name'];
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->avatar = $filename;
    $user->e_pid = $request['e_pid'];
    $user->e_gender = $request['e_gender'];
    $user->e_tel = $request['e_tel'];
    $user->e_comp_name = $request['e_comp_name'];
    $user->e_comp_address = $request['e_comp_address'];
    $user->e_comp_tel = $request['e_comp_tel'];
    $user->save();
    $user->roles()->attach(Role::where('name', 'Employer')->first());
    // $user->save();

    Auth::login($user);
    $id = Auth::user()->id;


    //ยืนยันตัวตน
    if ($request->hasFile('images'))
    {
      $files = $request->file('images');

      foreach($files as $file)
      {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $picture = date('His').$filename;
        $destinationPath = base_path() . '\public\uploads\identified';
        $file->move($destinationPath, $picture);

        $ident =new Identify; //บันทึกภาพที่อัพโหลด
        $ident->i_user_id = $id;
        $ident->i_pic_path = $picture;
        $ident->save();
      }
    }
    //ยืนยันตัวตน

    return redirect()->route('main');
  }
  //--------------------------------------------------------------------------------//
  //Test user profile
  public function getUsers()
  {
    $users = User::all();
    // dd($users);
    return view('users',compact('users'));
  }
  //--------------------------------------------------------------------------------//
  public function show($id, Request $request) //หน้าโปรไฟล์ profile
  {

    $users = User::all();
    $user = User::find($id);

    $user_info =  DB::table('users')
    ->join('user_role','user_role.user_id','=','users.id')
    ->where('users.id', $user->id)
    ->select('users.*','user_role.role_id')
    ->get();

    foreach ($user_info as $key => $value) { //check ว่าหน้าโปรไฟล์นั้นเป็นของ Free หรือ Emp
      $role = $value->role_id;
    }

    $check = Identify::where('i_user_id',$id)->exists();
    $status = Identify::where('i_user_id',$id)->groupBy('i_user_id')->get();
    // dd($check);


    //ข้างบนเอาไว้เรียกข้อมูลเจ้าของโปรไฟล์
    //------------------------------------------------------//
    //ข้างล่างเอาไว้เรียกข้อมูล รีวิว ของเจ้าของโปรไฟล์
    $get_review = Review::where('reviewed',$id)
    ->join('users','users.id','=','reviewer')
    ->join('post_jobs_details','post_jobs_details.id','=','job_detail_id')
    ->orderBy('reviews.id','desc')
    ->get();
    $count_reviewer = $get_review->count(); //นับผู้มารีวิว
    $rate_avg = Review::where('reviewed',$id)->groupBy('reviewed')->avg('rate'); //ค่าเฉลี่ยเรทติ้ง
    // dd($rate_avg);

    //--------------เรียกรายละเอียดการจ้างงานของสมาชิก
    if ($role == 2) { //Employer Data
      $econtact = DB::table('contact')
      ->join('users', 'users.id', '=', 'contact.f_id')
      ->join('post_jobs', 'post_jobs.slug', '=', 'contact.slug_id')
      ->join('post_jobs_details', 'post_jobs_details.id', '=', 'contact.job_detail_id')
      ->where('contact.status',1)
      ->where('post_jobs.user_id',$id)
      ->orderBy('contact.id','desc') //ดึงล่าสุดก่อน
      ->select('contact.f_id','contact.slug_id','post_jobs.title','post_jobs.slug','contact.status','post_jobs_details.position','post_jobs_details.id','post_jobs_details.start_date','post_jobs_details.end_date','contact.e_review_status','users.avatar','users.first_name','users.last_name')
      ->get();
      // dd($econtact);

    }elseif ($role == 1) { //Freelance Data

      $fcontact = DB::table('post_jobs') //ข้อมูลฟรีแลนซ์
      ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
      ->join('contact', 'contact.job_detail_id', '=', 'post_jobs_details.id')
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('contact.status','post_jobs_details.position','post_jobs_details.start_date','post_jobs_details.end_date','post_jobs.user_id','contact.e_review_status','users.avatar','users.first_name','users.last_name','users.e_comp_name')
      ->where('contact.status','=',1) //แสดงฉพาะคนที่ผู้ว่าจ้างรับแล้ว
      ->where('contact.f_id','=',$id)
      ->orderBy('contact.id','desc') //ดึงล่าสุดก่อน
      ->get();
      // dd($fcontact);
    }

    return view('profile',compact('users','user','user_info','get_review','count_reviewer','rate_avg','fcontact','econtact','role','check','status'));
  }
  //--------------------------------------------------------------------------------//
  public function reviews(Request $request) //รีวิวผู้ร่วมงานหน้า account-co
  {
    // $check = $request->get('j_detail_id');
    // dd($check);

    if (Auth::user()->isFreelance()) {
      // $check = $request->get('contact_id');
      // if ($check == true) {
        $rev = new Review(array(
          'job_slug' => $request->get('slug_id'),
          'job_detail_id' => $request->get('j_detail_id'),
          'reviewed' => $request->get('reviewed'),
          'reviewer' => $request->get('reviewer'),
          'comment' => $request->get('comment'),
          'rate' => $request->get('rating')
        ));
        // dd($rev);
        $rev->save();

        $review_status = DB::table('contact')  //เอาสถานะลงตาราง contact
        ->where('f_id', $request->get('reviewer'))
        ->where('job_detail_id',$request->get('j_detail_id'))
        ->update(['f_review_status' => 1]);

        return redirect()->back()->with('status','คุณได้ทำการรีวิวเสร็จเรียบร้อยแล้ว');

    //   }
    //
    //   else {
    //     return redirect()->back()->with('status2','คุณยังไม่ได้ทำการเลือกฟรีแลนซ์ กรุณาเลือกฟรีแลนซ์โดยคลิกเลือกที่คอลัมน์แรก');
    //   }
    }

    //------------------------------------------------------------------------//
    else {  //Employer
      // $check = $request->get('contact_id');
      // if ($check == true) {
        $rev = new Review(array(
          'job_slug' => $request->get('slug_id'),
          'job_detail_id' => $request->get('j_detail_id'),
          'reviewed' => $request->get('reviewed'),
          'reviewer' => $request->get('reviewer'),
          'comment' => $request->get('comment'),
          'rate' => $request->get('rating')
        ));
        // dd($rev);
        $rev->save();
        $review_status = DB::table('contact')   //เอาสถานะลงตาราง contact
        ->where('f_id', $request->get('reviewed'))
        ->where('job_detail_id',$request->get('j_detail_id'))
        ->update(['e_review_status' => 1]);

        return redirect()->back()->with('status','คุณได้ทำการรีวิวเสร็จเรียบร้อยแล้ว');
      // }
      // else {
      //     return redirect()->back()->with('status2','คุณยังไม่ได้ทำการเลือกฟรีแลนซ์ กรุณาเลือกฟรีแลนซ์โดยคลิกเลือกที่คอลัมน์แรก');
      // }
  }
}
  //--------------------------------------------------------------------------------//
  public function getAccountPage_Co($id)
  {
    $id = Auth::user()->id;
    $fuser = User::find($id);
    $status = Identify::where('i_user_id',$id)->groupBy('i_user_id')->get();
    $check_ident = Identify::where('i_user_id',$id)->exists();


    if (Auth::user()->isEmployer()) { //ถ้าเป็นผู้ว่าจ้าง
      $user = User::find($id);
      $check = Post_Job::whereUser_id($id)->exists();
      // dd($check);
      if ($check == true) {
        $hire = Post_Job::whereUser_id($id)->get();
        foreach ($hire as $key => $hi) {
          $slug = $hi->slug;
        }
        // dd($slug);

        $contact = DB::table('contact')
        ->join('users', 'users.id', '=', 'contact.f_id')
        ->join('post_jobs', 'post_jobs.slug', '=', 'contact.slug_id')
        ->join('post_jobs_details', 'post_jobs_details.id', '=', 'contact.job_detail_id')
        ->where('contact.status',1)
        ->where('post_jobs.user_id',$id)
        ->select('contact.f_id','contact.slug_id','post_jobs.title','post_jobs.slug','contact.status','post_jobs_details.position','post_jobs_details.id','contact.e_review_status','users.avatar','users.first_name','users.last_name')
        ->get();
        // dd($contact);


        $c = Contact::where('slug_id',$slug)->count(); //นับคอนแทคงานที่สเตตัสเป็น 1

        $get_review = Review::where('reviewer',$id)->groupBy('job_detail_id','reviewed')->get();
        // dd($get_review);
      }
      else {
        $c = 0;
        $contact = Post_Job::whereUser_id($id)->get();
      }
    }else{ //ถ้าเป็นฟรีแลนซ์
      // $emp=User::where('id',$user);

      $fcontact = DB::table('post_jobs')
      ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
      ->join('contact', 'contact.job_detail_id', '=', 'post_jobs_details.id')
      // ->join('users', 'users.id', '=', 'contact.f_id')
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('post_jobs.title','post_jobs.slug','contact.status','post_jobs_details.position','post_jobs_details.id','post_jobs.user_id','contact.f_review_status','users.avatar','users.first_name','users.last_name','users.e_comp_name')
      ->where('contact.status','=',1) //แสดงฉพาะคนที่ผู้ว่าจ้างรับแล้ว
      ->where('contact.f_id','=',$id)
      ->get();

      $get_review = Review::where('reviewer',$id)->groupBy('job_detail_id','reviewed')->get();


      $c = Contact::where('f_id',$id)->count();
      if($fcontact){
        if ($c !== 0) {
          foreach ($fcontact as $key => $value) {
            $slug_id = $value->slug;
            $emp_id = $value->user_id;
          }
          $user = User::find($emp_id);
        }
      }
    }

    return view('account-co',compact('hire','check','user','id','contact','fcontact','user','fuser','c','emp','get_review','status','check_ident')); //sent data to view
  }
  //--------------------------------------------------------------------------------//
  public function getAccountPage_Hire($id)
  {

    $id = Auth::user()->id;
    $fuser = User::find($id);
    $status = Identify::where('i_user_id',$id)->groupBy('i_user_id')->get();
    $check_ident = Identify::where('i_user_id',$id)->exists();



    if (Auth::user()->isEmployer()) { //ถ้าเป็น employer
      $user = User::find($id);
      $check = Post_Job::whereUser_id($id)->exists();

      if ($check == true) {

        $hire = Post_Job::whereUser_id($id)->get();
        foreach ($hire as $key => $hi) {
          $slug=$hi->slug;
        }

        $check_apply = DB::table('contact')
        ->join('post_jobs', 'post_jobs.slug', '=', 'contact.slug_id')
        ->join('post_jobs_details', 'post_jobs_details.id', '=', 'contact.job_detail_id')
        ->where('contact.status',0)
        ->select('contact.*','post_jobs_details.position','post_jobs.title')
        ->orderBy('contact.created_at','desc')
        ->get();
        foreach ($check_apply as $key => $c_appply) {
          $ch_slug=$c_appply->slug_id;
        }
        $count1 = Contact::with('post_job')->where('slug_id',$slug)->where('status',0)->get(); //นับที่ยังไม่จ้าง
        // dump($check_apply);
      } //if it true

      else {
        $contact = Post_Job::whereUser_id($id)->get();
        $hire = Post_Job::whereUser_id($id)->get();
      }
    }
    else { //ถ้าเป็นฟรีแลนซ์
      $fuser = User::find($id);
      $get_freelance = Contact::where('f_id',$id)
      ->join('post_jobs', 'post_jobs.slug', '=', 'contact.slug_id')
      ->join('post_jobs_details', 'post_jobs_details.id', '=', 'contact.job_detail_id')
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('contact.*','post_jobs_details.id','post_jobs_details.position','post_jobs.title','users.e_comp_name','post_jobs.user_id')
      ->groupBy('contact.job_detail_id')
      ->orderBy('contact.created_at','desc')
      ->get();
      // dd($get_freelance);
      $c = $get_freelance->count();
      // dd($c);
    }
    return view('account-hire',compact('count1','slug','user','check','check_apply','id','hire','contact','c','get_freelance','fuser','status','check_ident')); //sent data to view
  }
  //------------------------------------------------------------------
  public function getTest()
  {   $ctgr = Post_Job_Detail::with('category')->join('categories', 'categories.id', '=', 'post_jobs_details.job_category')
      ->groupBy('categories.name')
      ->orderBy('categories.id', 'asc')
      ->get(['categories.name','categories.id','post_jobs_details.job_category', DB::raw('count(post_jobs_details.job_category) as count_ct')]);


          return view('testad',compact('ctgr')); //sent data to view
  }
  //------------------------------------ADMIN-----------------------//
  public function getAdminPage() //หน้าหลัก แอดมิน
  {
    $freelances = DB::table('user_role')->where('role_id',1)->count(); //นับฟรีแลนซ์
    $employers = DB::table('user_role')->where('role_id',2)->count();  //นับผู้ว่าจ้าง
    $all = ($freelances+$employers);
    $jobs = DB::table('post_jobs')->count();  //นับงาน

    $ctgr = Post_Job_Detail::with('category')->join('categories', 'categories.id', '=', 'post_jobs_details.job_category')
    ->groupBy('categories.name')
    ->orderBy('categories.id', 'asc')
    ->get(['categories.name','categories.id', DB::raw('count(post_jobs_details.job_category) as count_ct')]);

    //----Donut chart Percentage-----
    $f_per = ($freelances * 100) / $all;
    $e_per = ($employers * 100) / $all;
    // dd($e_per);

    //----Bar chart Percentage-----
    $ctgr = Post_Job_Detail::with('category')->join('categories', 'categories.id', '=', 'post_jobs_details.job_category')
    ->groupBy('categories.name')
    ->orderBy('count_ct', 'desc')
    ->get(['categories.name','categories.id','post_jobs_details.job_category', DB::raw('count(post_jobs_details.job_category) as count_ct')]);


    $j_all = Post_Job_Detail::count();
    //------------users-----
    $new_f = DB::table('user_role')->where('role_id',1) //ฟรีมาใหม่
    ->join('users', 'users.id', '=', 'user_role.user_id')
    ->orderBy('users.id', 'desc')
    ->take(8)->get();

    $new_e = DB::table('user_role')->where('role_id',2) //ผู้ว่าจ้างมาใหม่
    ->join('users', 'users.id', '=', 'user_role.user_id')
    ->orderBy('users.id', 'desc')
    ->take(8)->get();
    // dd($new_e);


    return view('auth.admin',compact('new_e','new_f','all','jobs','freelances','employers','ctgr','categories','f_per','e_per','ctgr','j_all','j_per'));
  }
  //--------------------------------------------------------------------
  public function getAdminPage_Verify() //หน้า verify  users
  {
    $freelances = DB::table('user_role')
    ->join('users', 'users.id', '=', 'user_role.user_id')
    ->join('identifies', 'identifies.i_user_id', '=', 'user_role.user_id')
    ->groupBy('i_user_id')
    ->select('identifies.*','users.id','users.first_name','users.last_name')
    ->where('role_id',1)
    ->where('identifies.status',0)
    ->get(); //ฟรีแลนซ์

    $employers = DB::table('user_role')
    ->join('users', 'users.id', '=', 'user_role.user_id')
    ->join('identifies', 'identifies.i_user_id', '=', 'user_role.user_id')
    ->groupBy('i_user_id')
    ->select('identifies.*','users.id','users.first_name','users.last_name','users.e_comp_name')
    ->where('role_id',2)
    ->where('identifies.status',0)
    ->get();  //ผู้ว่าจ้าง

    $users_done = Identify::where('status',1)
    ->join('users', 'users.id', '=', 'identifies.i_user_id')
    ->join('user_role', 'users.id', '=', 'user_role.user_id')
    ->groupBy('users.id')
    ->get();

    //-------------------------------------------------------------------------
    $ident = Identify::where('status',0)->groupBy('i_user_id')->get();
    $count_ident = count($ident); //นับผู้รอการตรวจสอบ

    $identified = Identify::where('status',1)->groupBy('i_user_id')->get();
    $count_identified = count($identified); //นับผู้ที่ตรวจสอบแล้ว

    $all = $count_ident+$count_identified;

    $done_per = ($count_identified * 100) / $all; //Donut chart
    $wait_per = ($count_ident * 100) / $all;
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------

    return view('auth.admin-ver',compact('freelances','employers','users_done','count_ident','count_identified','done_per','wait_per'));
  }
  //--------------------------------------------------------------------
  public function getAdminPage_Edit() //หน้าแก้ไขข้อมูลแอดมิน
  {
    $id = Auth::user()->id;
    // //edit data
    $admininfo = DB::table('users')
                      ->select('users.first_name','users.last_name','users.f_pid','users.f_gender','users.f_address',
                      'users.f_tel','users.created_at')
                      ->where('id',$id)
                      ->get();

    return view('auth.admin-edit',compact('id','admininfo'));
  }

  public function updateAdminAccount(Request $request) //ส่งข้อมูลที่แก้ไข แอดมิน
  {

    $id = Auth::user()->id;

    $ad_update = ['id'=>$request->id
    ,'first_name'=>$request->first_name
    ,'last_name'=>$request->last_name
    ,'f_pid'=>$request->f_pid
    ,'f_gender'=>$request->f_gender
    ,'f_address'=>$request->f_address
    ,'f_tel'=>$request->f_tel];
    DB::table("users")->where('id',$request->id)->update($ad_update);

    $freelanceinfo = DB::table('users')
    ->select('users.first_name','users.last_name','users.f_pid','users.f_gender','users.f_address',
    'users.f_tel')
    ->where('id',$id)
    ->get();


    if($request->hasFile('avatar')){
      $avatar = $request->file('avatar');
      $filename = time(). '.' . $avatar->getClientOriginalExtension();

      $user = User::find(Auth::user()->id);

      // Delete current image before uploading new image
      if ($user->avatar !== 'avatar.png') {
        $file = public_path('uploads/avatars/' . $user->avatar);

        if (File::exists($file)) {
          unlink($file);
        }

      }

      Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/'. $filename));

      $user =Auth::user();
      $user->avatar = $filename;
      $user->save();
    }
    return redirect()->back()->with('status', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
  }
  //--------------------------------------------------------------------------------//
  public function user_identify(Request $request) //อัพโหลดไฟล์ ยืนยันตัวตน
  {
    $id = Auth::user()->id;
    $freelanceinfo = DB::table('users')
                      ->select('users.first_name','users.last_name','users.f_pid','users.f_gender','users.f_address',
                      'users.f_tel','users.f_job_skills','users.f_personal_skills','users.created_at','users.f_job_categories')
                      ->where('id',$id)
                      ->get();

    $employerinfo = DB::table('users')
                      ->select('users.first_name','users.last_name','users.e_pid','users.e_gender',
                      'users.e_tel','users.e_comp_name','users.e_comp_tel','users.e_comp_address','users.created_at')
                      ->where('id',$id)
                      ->get();


      if ($request->hasFile('images'))
      {
        $files = $request->file('images');

        foreach($files as $file)
        {
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $picture = date('His').$filename;
          $destinationPath = base_path() . '\public\uploads\identified';
          $file->move($destinationPath, $picture);

          $ident =new Identify; //บันทึกภาพที่อัพโหลด
          $ident->i_user_id = $id;
          $ident->i_pic_path = $picture;
          $ident->save();
        }
        // return redirect()->back()->with('status', 'บันทึกไฟล์เรียบร้อยแล้ว ระบบจะใช้เวลาไม่เกิน 7 วันในการตรวจสอบข้อมูล');
        return redirect()->action('MainController@getEditAccountPage', ['id' => $id])->with('status', 'บันทึกไฟล์เรียบร้อยแล้ว ระบบจะใช้เวลาไม่เกิน 7 วันในการตรวจสอบข้อมูล');
      }

    return view('auth.user_identify');
  }
  //--------------------------------------------------------------------------------//
  public function getAdminPage_Verify_Detail($id, Request $request) //เข้าดูไฟล์ ยืนยันตัวตน
  {
    $check = DB::table('user_role')->where('user_id',$id)->get();
    foreach ($check as $key => $value) {
      $role_id = $value->role_id;
    }
    $data = User::where('id',$id)->get();

    $pics = Identify::where('i_user_id',$id)->get();
    // dd($data);

    return view('auth.ver-detail',compact('role_id','data','pics'));
  }
  //--------------------------------------------------------------------------------//
  public function getAdminPage_Verify_Detail_Answer($id, Request $request) //ยืนยันตัวตน หรือ ให้ส่งข้อมูลใหม่
  {
    $no = $request->get('no'); // ข้อมูลไม่ครบ ให้ส่งเมล
    $yes = $request->get('yes'); //ยืนยัน
    $mytime = Carbon::now();
    $status_date = $mytime->toDateString();

    if (isset($yes)) {
      $update = DB::table('identifies')
                ->where('i_user_id',$id)
                ->update(
                ['status' => 1, 'status_created' => $status_date]);

      return redirect(action('AuthController@getAdminPage_Verify'))->with('status', 'ข้อมูลของสมาชิกถูกยืนยันแล้ว ');

      // return redirect()->back()->with('status', 'ข้อมูลของสมาชิกถูกยืนยันแล้ว ');
    }
    if (isset($no)) {
      $info = User::where('id',$id)->get();


      Mail::send('emails.ident_failed',['info' => $info], function($message){
        $message->from('freelanceburiram@gmail.com','เว็บจัดหางานฟรีแลนซ์บุรีรัมย์');
        $message->to('preeyanoot2013@gmail.com')->subject('แจ้งเตือน ยืนยันข้อมูลไม่สำเร็จ!');
      });

      $delete = Identify::where('i_user_id',$id)->delete();

      return redirect(action('AuthController@getAdminPage_Verify'))->with('status2', 'ส่งอีเมลแจ้งเตือนไปยังสมาชิกแล้ว ว่าข้อมูลไม่ครบ');
    }

  }
  //--------------------------------------------------------------------------------//
}
