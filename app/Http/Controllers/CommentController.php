<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentFormRequest;
use App\Comment;

class CommentController extends Controller
{
  public function newComment(CommentFormRequest $request)
  {
      $comment = new Comment(array(
          'post_id' => $request->get('post_id'),
          'content' => $request->get('content')
      ));

      $comment->save();

      return redirect('/jobsboard/{slug?}')->with('status', 'เพิ่มความคิดเห็นเรียบร้อยแล้ว!');
  }
}
