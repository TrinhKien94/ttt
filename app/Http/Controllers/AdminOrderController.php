<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Orderline;
use App\Http\Model\Order;
use App\Http\Model\Book;
class AdminOrderController extends Controller
{
    public function history(){
        if(Auth::user()->role !== 1) return redirect('/');
        $orders = Order::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return Controller::myView('admin_order.history')->with('orders',$orders);
    }
    public function done(Request $request){
         if(Auth::user()->role !== 1) return redirect('/');
         $order = Order::find((int)$request->input('order_id'));
         $order->status = 1;
         $order->save();
    }
    public function noDone(Request $request){
         if(Auth::user()->role !== 1) return redirect('/');
         $order = Order::find((int)$request->input('order_id'));
         $order->status = 0;
         $order->save();
    }
}
