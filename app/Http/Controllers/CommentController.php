<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Comment;
use Auth;
use Validator;
use Response;
class CommentController extends Controller
{
    public function postComment(Request $request ){
        $validator = Validator::make($request->all(), [
            'comment'=>'required|between:1,1000',
        ]);
        if ($validator->fails())
        {
            $errors = $validator->messages()->toArray();
            echo json_encode($errors);
        }else{
            $content = preg_replace("/\r\n|\r/", "<br />", $request->input('comment'));
            $comment = new Comment;
            $comment->user_id=Auth::user()->id;
            $comment->book_id=(int)$request->input('book_id');
            $comment->content = $content;
            $comment->save();
            $true['book_id']=$comment->book_id;
            $true['comment']='true';
            echo json_encode($true);
        }
    }
}
