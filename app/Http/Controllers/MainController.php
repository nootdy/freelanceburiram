<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;

use App\Post_Job;
use App\Post_Job_Detail;
use App\Category;
use App\Review;
use App\Identify;

use App\Employer;
use App\Freelance;
use Auth;
use DB;
use Mail;


class MainController extends Controller
{
    public function getIndex(Request $request)
    {
      $c = DB::table('user_role')->where('role_id',1)->count(); //นับฟรีแลนซ์
      $b = DB::table('user_role')->where('role_id',2)->count();  //นับผู้ว่าจ้าง
      $a = DB::table('post_jobs')->count();  //นับงาน

      $oldsearch = $request->input('search');

      $categories = Category::with('categories')->get();
      // dd($categories);
      $count= $categories->count();

      $ctgr = Post_Job_Detail::with('category')->join('categories', 'categories.id', '=', 'post_jobs_details.job_category')
      ->groupBy('categories.name')
      ->orderBy('categories.id', 'asc')
      ->get(['categories.name','categories.id', DB::raw('count(post_jobs_details.job_category) as count_ct')]);
      //  dd($ctgr);

      if (Auth::check()) { //เอาไว้ส่งค่า id หลัง login  จะได้ไม่ error เพราะมันไม่รู้ว่าว่า user คือใครถ้ายังไม่ login
        $id = Auth::user()->id;
      }

      return view('index',compact('a','b','c','oldsearch','categories','ctgr','id'));
    }
    //----------------------------------------------------------//
    public function getFreelancesBoardPage(Request $request)
    {
      $oldsearch = $request->input('search'); //คำค้นหา
      $data = $request->has('search');

      //search full-text-sql
        if($data){
          //User::WhereRaw("ALTER TABLE 'users' ADD FULLTEXT (f_job_skills,f_personal_skills)");
          $ces = DB::table('users')
          ->join('user_role', 'users.id', '=','user_role.user_id')
          // ->where('role_id',1)
          ->WhereRaw("
                  MATCH(f_job_skills,f_personal_skills) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE) OR
                  MATCH(f_job_categories) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE) OR
                  MATCH(f_address) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE)")
                   //not admin
          ->select('users.*')
          ->whereNotIn('role_id',[3])
          ->get();
          // dd($ces);
          $count = count($ces);

          // if ($ces == []) { //แบคอัพ ค้นหาธรรมดา %like%
          //   $ces = DB::table('user_role')
          //     ->join('users', 'users.id', '=', 'user_role.user_id')
          //     ->where('role_id',1)
          //     ->where('f_job_categories','LIKE','%'.$request->search.'%')
          //     ->orWhere('f_job_skills','LIKE','%'.$request->search.'%')
          //     ->orWhere('f_personal_skills','LIKE','%'.$request->search.'%')
          //     ->whereNotIn('id',[6])
          //     ->select('users.*')
          //     ->get();
          //
          //     $count = count($ces); //นับจำนวนที่ค้นเจอ
          // }
        }

          $freelances = DB::table('user_role')
          ->join('users', 'users.id', '=', 'user_role.user_id')
          ->where('role_id',1)
          ->select('users.*')
          ->paginate(4);

          // ->get();
          // dd($freelances);

          $check = DB::table('user_role')
          ->join('users', 'users.id', '=', 'user_role.user_id')
          ->join('reviews', 'reviews.reviewed', '=' , 'users.id')
          ->where('role_id',1)
          ->groupBy('reviewed')
          ->get();
          // dd($check);

          $category = Category::all();

          $c = DB::table('user_role')->where('role_id',1)->count(); //นับฟรีแลนซ์

        return view('freelancesboard', compact('freelances','c','check','test','category','oldsearch','search','data','ces','count'));
    }
    //----------------------------------------------------------//
    public function viewJobsBoard(Request $request) //เรียกหน้าประกาศงาน
    {

      $a = DB::table('post_jobs')->where('status',0)->count();

      $jobs = Post_Job::with('post_jobs_details')->orderBy('id', 'desc')->where('status',0)->paginate(3); //อันนี้ get มันมาก่อนทั้งหมด
      $group = $jobs->map(function($jobs) {
        return $jobs->post_jobs_details;
      })->groupBy('post_id')->first(); //group
      // dd($group);

                //
                // if($request->has('search')){
              	// 	$jobs = Post_Job::search($request->input('search'))->toArray();
              	// }

                $oldsearch = $request->input('search');


        return view('/jobsboard', compact('a','oldsearch','jobs','job','group')); //compact('jobs') ก็คืออันเดียวกับ ['jobs'=>$jobs]
    }
    //----------------------------------------------------------//
    public function search(Request $request)
    {
      $from_profile = $request->get('company'); //ปุ่มจากหน้าโปรไฟล์ ค้นหาตามชื่อบริษัท
      $from_index = $request->get('b1'); //ปุ่มจากหน้าหลัก ค้นหาตามประเภท
      $oldsearch = $request->input('search'); //คำค้นหา
      // ----------------------------------------------

      //--start---จากหน้าหลัก ถ้าค้นหาตามประเภทงาน------------
      if (isset($from_index)) {
        $jobs = Post_Job::with('post_jobs_details')
        ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
        ->join('users', 'users.id', '=', 'post_jobs.user_id')
        ->orderBy('post_jobs.id', 'desc')
        ->where('status',0)
        ->where('job_category','LIKE','%'.$from_index.'%')
        ->get();

        // dd($jobs);
        $a = count($jobs);

        return view('/search', compact('oldsearch','a','jobs')); //compact('jobs') ก็คืออันเดียวกับ ['jobs'=>$jobs]
      }
      //--end---จากหน้าหลัก ถ้าค้นหาตามประเภทงาน------------

      //--start---ถ้าค้นหาแบบ Full Text------------
      if($request->has('search')){

            //--------elastic search----
            // $result = Post_Job::search($request->input('search'))->toArray();
            //--------elastic search----

            //--------Like search----
            // $jobs = Post_Job::with('post_jobs_details')
            // ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
            // ->join('users', 'users.id', '=', 'post_jobs.user_id')
            // ->orderBy('post_jobs.id', 'desc')
            // ->where('status',0)
            // ->where('position','LIKE','%'.$request->search.'%')
            // ->get();
            //--------Like search----

            //--------Full-Text search----
            $jobs = DB::table('post_jobs_details as a')
            ->join('post_jobs as b', 'a.post_id', '=', 'b.id')
            ->join('users as c', 'c.id', '=', 'b.user_id')
            ->WhereRaw("
                    MATCH(position) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE) OR
                    MATCH(job_description) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE) OR
                    MATCH(title) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE) OR
                    MATCH(e_comp_name) AGAINST ('$request->search' IN NATURAL LANGUAGE MODE)")
            ->where('status',0)
            ->get();

            $a = count($jobs); //นับจำนวนงานที่ขึ้นมาแสดง

            return view('/search', compact('oldsearch','a','jobs')); //compact('jobs') ก็คืออันเดียวกับ ['jobs'=>$jobs]

          }
      //--end---ถ้าค้นหาแบบ Full Text------------


      if (isset($from_profile)) {
        $jobs = Post_Job::with('post_jobs_details')
        ->join('post_jobs_details', 'post_jobs_details.post_id', '=', 'post_jobs.id')
        ->join('users', 'users.id', '=', 'post_jobs.user_id')
        ->orderBy('post_jobs.id', 'desc')
        ->where('status',0)
        ->where('e_comp_name','LIKE','%'.$from_profile.'%')
        ->get();

        // dd($jobs);
        $a = count($jobs);
        $oldsearch = $from_profile; //คำค้นหา
        // dd($oldsearch);
      }
      if ($oldsearch == "") { //ถ้าช่องค้นหาว่าง
          return redirect(action('MainController@viewJobsBoard'));
      }

      return view('/search', compact('data','result','oldsearch','b','a','jobs','group','from_profile')); //compact('jobs') ก็คืออันเดียวกับ ['jobs'=>$jobs]

    }
    //--------------------------------------------------------------------------------//
    public function getEditAccountPage()
    {
      $id = Auth::user()->id;
      // //edit data
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
      $category = Category::all();

      $status = Identify::where('i_user_id',$id)->groupBy('i_user_id')->get();
      $check_ident = Identify::where('i_user_id',$id)->exists();


        return view('editaccount',compact('id','freelanceinfo','employerinfo','category','check','status','check_ident'));
    }
    // //--------------------------------------------------------------------------------//
    public function profiles()
    {
        return view('profiles');
    }
    //----------------------------------------------------------//
    public function sendmail()
    {
      $user = Auth::user()->id;

      $title = DB::table('post_jobs') //call title by slug
      ->join('users', 'users.id', '=', 'post_jobs.user_id')
      ->select('post_jobs.*','users.*')
      ->where('user_id',$user)
      ->get();

      foreach ($title as $key => $value) {
        $company = $value->e_comp_name;
      }

      // dd($company);


      $data = array(
        'name' => "Freelance Buriram",
        'employer' => $user,
      );
      Mail::send('emails.hire',['title' => $title,'company' => $company], function($message){
        $message->from('freelanceburiram@gmail.com','เว็บจัดหางานฟรีแลนซ์บุรีรัมย์');
        $message->to('preeyanoot2013@gmail.com')->subject('แจ้งเตือน ผู้ว่าจ้างมาติดต่อจ้างงาน');
      });
      return redirect()->back()->with('status','ระบบทำการส่งอีเมลแจ้งความประสงค์ในการจ้างงานของคุณ ไปยังฟรีแลนซ์เรียบร้อยแล้ว');
    }
    //----------------------------------------------------------//

}
