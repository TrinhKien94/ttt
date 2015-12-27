<?php

namespace App\Http\Controllers;

use Validator;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Request_book;
class RequestBookController extends Controller
{
    public function addRequest(Request $request){
        $validator = Validator::make($request->all(), [
            'content'=>'required|between:1,1000',
            'email'=>'required|email',
        ]);
        if ($validator->fails())
        {
            $errors = $validator->messages()->toArray();
            echo json_encode($errors);
        }else{
            $true['email']='true';
            $request_book= new Request_book;
            $request_book->email = $request->input('email');
            $request_book->content =preg_replace("/\r\n|\r/", "<br />", $request->input('content'));
            $request_book->save();
            echo json_encode($true);
        }
    }
}
