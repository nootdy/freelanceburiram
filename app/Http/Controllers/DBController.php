<?php

namespace App\Http\Controllers;

use App\Freelance;
use App\User;
use App\Role;
Use DB;
use Illuminate\Http\Request;
use App\Category;

class DBController extends Controller
{
    public function search_by_cate(Request $request)
    {
      $oldsearch = $request->input('search'); //คำค้นหา
      if ($oldsearch == "") {
        return redirect(action('MainController@getFreelancesBoardPage'));
      }

        if($request->has('search')){
      if($request->has('law')){
        $freelances = DB::table('user_role')
        ->join('users', 'users.id', '=', 'user_role.user_id')
        ->where('role_id',1)
        ->where('f_job_categories','LIKE','%'.$request->search.'%')
        ->select('users.*')
        ->get();
      }
      dd($freelances);

      $freelances = DB::table('user_role')
      ->join('users', 'users.id', '=', 'user_role.user_id')
      ->where('role_id',1)
      ->select('users.*')
      ->get();
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
      return view('freelancesboard-search',compact('freelances','check'));
    }


    //-------------------------------------------------------------------------
    public function getCategory()
    {
      $categories = Category::all();
      return View('/category')->with('categories',$categories);

    }


}
