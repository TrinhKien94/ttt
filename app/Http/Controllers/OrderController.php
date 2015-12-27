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
class OrderController extends Controller
{
    public function history(){
        $orders = Order::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return Controller::myView('order.history')->with('orders',$orders);
    }
    public function show($id){
            $order = Order::find($id);
            if($order->user_id===Auth::user()->id){
                $orderlines=$order->orderlines()->get();
                $containers = array();
                foreach ($orderlines as $orderline ) {
                    $data=array();
                    $data['orderline']=$orderline;
                    $data['book']=$orderline->book;
                    $containers[]=$data;
                }
                return Controller::myView('order.show')->with('containers',$containers)->with('total',$order->money);
            }else{
                return redirect("/");
            }
    }
    public function cancel(){

    }
    public function order_one(Request $request){
        $order = new Order;
        $book = Book::find((int)$request->input('book_id'));
        if(Auth::guest())
        	return 'notLogin';
    	if($book->quantity<=0){
    	    return 'notHave';
    	}
        $orderline = new Orderline;
        $order->user_id=Auth::user()->id;
        $order->date=Carbon::now();
        $order->money = $book->price;
        $order->save();
        $orderline->order_id=$order->id;
        $orderline->book_id = $book->id;
        $orderline->quantity =1;
        $orderline->price = $book->price;
        $orderline->save();
        $book->quantity=$book->quantity-1;
        $book->save();
        return $order->id;
        return 357;
    }
    public function store(){
        $error = array();
        $error['qtys']=array();
        $error['deleted']=array();
        $count=0;
        if(Auth::guest())
            return redirect('auth/login');
        else{
            if(Cart::total()>1000){
                $error['money']="<li>Tổng số tiền phải < 1 triệu</li>";
                $count++;
            }
            $containers=array();
            $container=array();
            $cart =Cart::content();
            foreach ($cart as $item){
                $book = Book::find($item->id);
                if($book->quantity < $item->qty){
                    array_push($error['qtys'],"<li>Số lượng hiện tại nhiều hơn số sách '$book->title' đang có</li>");
                    $count++;
                }
                if($book->deleted==1){
                    array_push($error['deleted'],"<li>Sách '$book->title' đã bị xóa</li>");
                    $count++;
                }
            }
            if($count>0){
                $error['error']="true";
                return json_encode($error);
            }
            $order = new Order;
            $order->user_id=Auth::user()->id;
            $order->date= Carbon::now();
            $order->money = Cart::total();
            $order->save();
            foreach ($cart as $item) {
                $orderline = new Orderline;
                $orderline->order_id= $order->id;
                $orderline->quantity = $item->qty;
                $orderline->book_id= $item->id;
                $orderline->price = $item->subtotal;
                $orderline->save();
            }
            $error["error"]="false";
            $error["order_id"]=$order->id;
            Cart::destroy();
            return json_encode($error); 
        }
    }
    public function checkQuantity($quantity,$book){
        if($quantity > $book->quantity) return false;
        return true;
    }
}
