<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Request_book;
class AdminRequestBookController extends Controller
{
    public function showRequestList(){
        if(Auth::user()->role !== 1) return redirect('/');
        $requests = Request_book::where('id','>',0)->orderBy('id', 'DESC');
        if(!$requests->first()){
            return Controller::myView('admin_request.request')->with('requests',1);
        }
        $requests=$requests->paginate(16);
        return Controller::myView('admin_request.request')->with('requests',$requests);
    }
    public function read(Request $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $rq = Request_book::find((int)$request->input('request_id'));
            $rq->already_read=1;
            $rq->save();
    }
    public function delete(Request $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $rq = Request_book::find((int)$request->input('request_id'));
        $rq->delete();
    }
}
