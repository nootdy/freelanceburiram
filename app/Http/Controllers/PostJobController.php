<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\Post_JobFormRequest;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Post_Job;
use App\Post_Job_Detail;
use App\Comment;
use App\Contact;
use Carbon;
use Auth;
use DB;


class PostJobController extends Controller
{

  public function getPostjobPage() //เรียกหน้าประกาศงาน
  {
      $user = Auth::user()->id;
      $check = Post_Job::where('user_id',$user)->where('status',0)->count();
      $limit_user = DB::table('contact')
                      ->join('post_jobs','contact.slug_id','=', 'post_jobs.slug')
                      ->where('post_jobs.user_id',$user)
                      ->where('contact.e_review_status',0)
                      ->get();
      // dd($limit_user);
      // dd($check);
      $categories = Category::all();
      return view('postjob',compact('categories','user','check','limit_user'));
  }
  //--------------------------------------------------------------------------------//
  public function store(Request $request) //สร้างประกาศงานใหม่
  {


    $user = Auth::user()->id;
    $slug = uniqid();


    $job = Post_Job::create(array(
      'title' => $request->get('title'),
      'slug' => $slug,
      'user_id' => $user
    ));
    $job->save();

        if ($request->has('pos')) {
           foreach ($request->input('pos') as $key => $repeater) {

             $repeaters = Post_Job_Detail::create(array(
                'post_id' => $job->id,
                'position' => $repeater['position'],
                'amount' => $repeater['amount'],
                'job_category' => $repeater['job_category'],
                'min_pay' => $repeater['min_pay'],
                'max_pay' => $repeater['max_pay'],
                'start_date' => $repeater['start_date'],
                'end_date' => $repeater['end_date'],
                'job_description' => $repeater['job_description']
             ));
              $repeaters->save();
           }
         }
      return redirect('/postjob')->with('status',''.$slug);
  }
  //--------------------------------------------------------------------------------//
  public function show($slug) //เรียกหน้าประกาศงานตามหมายเลขประกาศ
  {

      $title = Post_Job::whereSlug($slug)->firstOrFail()
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('post_jobs.*','users.id','users.first_name','users.last_name','users.e_comp_tel','users.e_comp_name','users.e_comp_address','users.avatar')
      ->whereSlug($slug)
      ->get(); //$tt
      // dd($title);


      $job = Post_Job::whereSlug($slug)->firstOrFail()
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
      ->select('post_jobs.slug','post_jobs.title','post_jobs.id','users.first_name','users.last_name','users.avatar','post_jobs_details.job_category',
        'post_jobs_details.id','post_jobs_details.job_description','post_jobs.created_at','post_jobs_details.position','post_jobs_details.amount')
      ->whereSlug($slug)
      ->get(); //$inf


      $test = Post_Job::whereSlug($slug)->firstOrFail() //เรียกประเภทงานตาม position
      ->join('post_jobs_details', 'post_id', '=', 'post_jobs.id')
      ->join('categories', 'categories.id', '=', 'post_jobs_details.job_category')
      ->select('categories.name','post_jobs.*','post_jobs_details.*')
      ->whereSlug($slug)
      ->orderBy('post_jobs_details.id','asc')
      ->get();

      foreach ($test as $key => $value) {
        // dd($value->position);

      //   for($x=0;$x<count($test);$x++) {
      //     $position = $test[$x]->position;
      //     $name = $test[$x]->name;
      //
      //   $match = DB::table('users')
      //   ->WhereRaw("
      //   MATCH(f_job_skills) AGAINST ('$value->position' IN NATURAL LANGUAGE MODE) OR
      //   MATCH(f_job_categories) AGAINST ('$name' IN NATURAL LANGUAGE MODE)")
      //   ->select('users.first_name','users.last_name','users.avatar','users.f_job_skills','users.id','users.f_job_categories')
      //   ->get();
      // }
    }
      // dd($match);


      $comments = DB::table('comments') //join 3 tables.
              ->join('post_jobs', 'post_jobs.id', '=', 'comments.post_id')
              ->join('users', 'users.id', '=', 'comments.user_id')
              ->select('comments.user_id','comments.content','comments.created_at','users.first_name','users.last_name','users.avatar')
              ->whereSlug($slug) //แสดงเฉพาะหน้านั้นๆ
              ->orderBy('comments.id', 'desc')
              ->get();



      return view('showpostjob',compact('job','comments','title','test','category'));
  }
  //--------------------------------------------------------------------------------//
  public function newComment(Request $request)
  {
      $user = Auth::user()->id;

      $comment = new Comment(array(
          'post_id' => $request->get('post_id'),
          'content' => $request->get('content'),
          'user_id' => $user
      ));

      $comment->save();

    return redirect()->back()->with('status', 'เพิ่มความคิดเห็นเรียบร้อยแล้ว!');
  }
  //--------------------------------------------------------------------------------//
  public function edit($slug) //เรียกหน้าแก้ไขหน้าประกาศงานตามหมายเลขประกาศ
  {
      // dd($slug);
      $categories = Category::all();

      $title = Post_Job::whereSlug($slug)->firstOrFail()
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('post_jobs.*','users.*')
      ->whereSlug($slug)
      ->get(); //$tt

      $jobs = Post_Job::whereSlug($slug)->firstOrFail()
      ->join('post_jobs_details', 'post_jobs.id', '=', 'post_jobs_details.post_id')
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('post_jobs_details.*')
      ->whereSlug($slug) //แสดงเฉพาะหน้านั้นๆ
      ->get();

      foreach ($jobs as $key => $value) {
        $jdt_id = $value->id;
      }

      $check = Contact::where('job_detail_id',$jdt_id)->where('status',1)->exists(); //เช็คว่างานนี้มีคนสมัครรึยัง ถ้ามีจะไม่ให้แก้ไข

      return view('editpostjob',compact('categories','title','jobs','slug','check'))->with('status','');
  }
  //--------------------------------------------------------------------------------//
  public function update($slug ,Request $request) //แก้ไขหน้าประกาศงานตามหมายเลขประกาศ
  {
      $categories = Category::all();

      //แก้ไขหัวข้อประกาศงาน
      $title_but = Input::get('title_edit');
           if (isset($title_but))
           {
             $jobs = Post_Job::whereSlug($slug)->firstOrFail();
             $jobs->title = $request->get('title');
             $jobs->save();

             return redirect()->back()->with('status','ประกาศหมายเลข :'.$slug.'ได้ถูกแก้ไขเรียบร้อยแล้ว');
           }


      //แก้ไขทีละตำแหน่ง
      $id = Input::get('details_id');

      $details_but = Input::get('details_edit');
      if (isset($details_but))
      {
        if ($request->input('details_id') == null) {
          return redirect()->back()->with('status2','คุณยังไม่ได้ทำการเลือกตำแหน่งงานที่ต้องการแก้ไข');
        }
        else {
          foreach ($id as $key => $value) {
            $job_update =
            ['start_date'=>$request->start_date,
             'end_date'=>$request->end_date,
             'amount'=>$request->amount,
             'min_pay'=>$request->min_pay,
             'max_pay'=>$request->max_pay,
             'job_description'=>$request->job_description];
            // dd($value);
            DB::table("post_jobs_details")->where('id',$value)->update($job_update);
          }
        }
        return redirect()->back()->with('status','ประกาศหมายเลข :'.$slug.'ได้ถูกแก้ไขเรียบร้อยแล้ว');
      }
  }
  //--------------------------------------------------------------------------------//
  public function destroy($slug) //ลบประกาศงาน ตอนนี้ไม่ได้ใช้ ใช้วิธีปิดเอา เดี๋ยวความสัมพันธ์หาย
  {
      $job = Post_Job::whereSlug($slug)->firstOrFail();
      $job->delete();

      return redirect('/jobsboard')->with('status','ประกาศหมายเลข :'.$slug.'ได้ถูกลบเรียบร้อยแล้ว');
  }
  //--------------------------------------------------------------------------------//
  public function status($slug) //เปิด ปิด ประกาศงาน
  {
    $job_status =Post_Job::whereSlug($slug)->firstOrFail();

      if ($job_status->status == 0) {
        $job_status->status = '1';
        $job_status->save();
        return redirect(action('PostJobController@show',$job_status->slug))->with('status','ประกาศหมายเลข :'.$slug.'ได้ถูกปิดเรียบร้อยแล้ว');
      }
      else {
        $job_status->status = '0';
        $job_status->save();
        return redirect(action('PostJobController@show',$job_status->slug))->with('status','ประกาศหมายเลข :'.$slug.'ได้ถูกเปิดเรียบร้อยแล้ว');
      }
    // dd($job_status);
  }
  //--------------------------------------------------------------------------------//

}
