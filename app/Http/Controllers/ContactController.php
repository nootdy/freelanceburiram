<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

use App\Contact;
use App\Post_Job;
use App\Post_Job_Detail;
use App\Review;
use App\Hire;
use Auth;
use DB;


class ContactController extends Controller
{
  public function apply($slug, Request $request) //สมัครงาน
  {

    $user = Auth::user()->id;

    $jobs = Post_Job::whereSlug($slug)->firstOrFail(); //เรียกเลข job_detail_id ของงานนั้น

    $check_button = $request->input('job_detail_id'); //มีการเลือกตำแหน่งงานหรือไม่

    if ($check_button == null) { //ถ้าไม่มี
      return redirect(action('PostJobController@show',$jobs->slug))->with('status3','คุณยังไม่ได้เลือกตำแหน่งงานที่จะสมัคร');
    }
    else { //ถ้ามี
      $check = DB::table('contact')
      ->where('f_id', '=', $user)
      ->where('job_detail_id', '=', $request->input('job_detail_id'))
      ->exists();

      // เช็คว่าสมัครงานนี้ไปแล้วรึยัง ป้องกันการลงข้อมูลซ้ำ
      $limit_user = Contact::where('f_id',$user)->where('f_review_status',0)->count();
      if ($limit_user >= 3) {
        return redirect(action('PostJobController@show',$jobs->slug))->with('status2','คุณยังมีงานที่กำลังดำเนินการอยู่ กรุณารีวิวเพื่อนร่วมงานเก่า เพื่อยืนยันว่าการจ้างงานนั้นสิ้นสุดแล้ว ก่อนทำการสมัครงานใหม่');
      }

      if ($check === true) { //ถ้าสมัครไปแล้ว
        return redirect(action('PostJobController@show',$jobs->slug))->with('status4','คุณได้ทำการสมัครงานนี้ไปแล้ว');
      } //เช็คว่าสมัครงานนี้ไปแล้วรึยัง กันข้อมูลซ้ำในตาราง
      else {
          foreach ($request->input('job_detail_id') as $key => $de) {
          $apply = new Contact(array(
            'slug_id' => $slug,
            'job_detail_id' => $de,
            'f_id' => $user
          ));
          // dd($apply);
          $apply->save();

          return redirect(action('PostJobController@show',$jobs->slug))->with('status','คุณได้ทำการสมัครงานเรียบร้อยแล้ว');
         }
      }
    }


  }
  //--------------------------------------------------------------------------------//
  public function ContactStatus($slug, Request $request) //
  {
    $id = Auth::user()->id;

    $title = Post_Job::whereSlug($slug)->firstOrFail() //call title by slug
    ->join('users', 'users.id', '=', 'post_jobs.user_id')
    ->select('post_jobs.*','users.*')
    ->whereSlug($slug)
    ->get(); //$tt

    $contact = DB::table('post_jobs')
                      ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
                      ->join('contact', 'contact.job_detail_id', '=', 'post_jobs_details.id')
                      ->join('users', 'users.id', '=', 'contact.f_id')
                      ->select('post_jobs.slug','contact.id','contact.job_detail_id','contact.f_id','contact.created_at','post_jobs_details.position','users.avatar','users.first_name','users.last_name')
                      ->where('user_id',$id)
                      ->where('contact.slug_id','=',$slug)
                      ->where('contact.status','=',0) //แสดงฉพาะคนที่ผู้ว่าจ้างยังไม่รับ
                      ->get();
    // dd($contact);

                      if ($contact !== []) {
                        foreach ($contact as $key => $value) {
                          $value->f_id;
                        }
                        $freelance =$value->f_id;
                        // dd($freelance);
                        $count1 = Contact::with("post_jobs_details")->where('contact.slug_id','=',$slug)->where('status',0)->count(); //นับที่ยังไม่จ้าง
                        $count2 = Contact::with("post_jobs_details")->where('contact.slug_id','=',$slug)->where('status',1)->count(); //นับที่จ้างแล้ว
                      }

    return view('freelancelist',compact('id','title','contact','count1','count2')); //sent data to view
  }
  //--------------------------------------------------------------------------------//
  public function EmpAnswer(Request $request) //สถานะตอบรับผู้ว่าจ้าง รับ หรือ ไม่รับ View:: freelancelist
  {
    $con_id= Input::get('id'); //เลขไอดีคอนแทคที่เลือก


    if ($request->input('id') == null) {
      return redirect()->back()->with('status2','คุณยังไม่ได้ทำการเลือกรายชื่อ');
    }

    $input = Input::get('ok');
         if (isset($input))
         {
         foreach ($con_id as $key => $value) {
             $apply = DB::table('contact')
                     ->where('id',$value)
                     ->update(['status' => 1]);
                   }

                   return redirect()->back()->with('status','คุณได้ทำการรับฟรีแลนซ์ทำงานเรียบร้อยแล้ว');
         }

    $input2 = Input::get('deny');
          if (isset($input2))
          {
            foreach ($con_id as $key => $value) {
              $deny = DB::table('contact')
                          ->where('id', $value)
                          ->delete();
            }
                      return redirect()->back()->with('status1','คุณได้ทำการปฏิเสธฟรีแลนซ์ที่เลือกเรียบร้อยแล้ว');
  }
}
//--------------------------------------------------------------------------------//
public function hire_freelance($id,Request $request) //สมัครงาน
{
  $user = Auth::user()->id;
  $input_button = Input::get('hire');

  if(isset($id))
  {
    $hire = new Hire(array(
      'emp_id' => $user,
      'f_id' => $id
    ));
    dd($hire);
    $hire->save();
  }
  return redirect(action('MainController@getFreelancesBoardPage'))->with('status','ระบบได้ทำการแจ้งความต้องการ "จ้างงาน" ของคุณไปยังฟรีแลนซ์เรียบร้อยแล้ว');
}

//--------------------------------------------------------------------------------//


}
