@extends('layout.admin')
@section('title','Lịch sử đặt hàng')
@section('content-title','Lịch sử đặt hàng')
@section('content')
	<table class="order">
	    <thead>
	        <tr class="cart_menu">
	            <td class="index">STT</td>
	            <td class="item-title">Ngày đặt</td>
	            <!-- <td class="description"></td> -->
	            <td class="total">Tổng</td>
	            <td class="total">Chi tiết</td>
	            <td>Cập nhật trạng thái</td>
	        </tr>
	    </thead> 
	    <tbody>
	    {{--*/$i=0 /*--}}
    	@foreach($orders as $order)
    		<tr>
    			{{--*/$i=$i+1 /*--}}
    			<td>{{$i}}</td>
    			<td>{{$order->date}}</td>
    			<td>{{$order->money}}.000 VNĐ</td>
			    <td>
			            <a href="{{url()}}/order/{{$order->id}}">Xem</a>
			    </td>
			    <td>
			    	<form action="{{url('/admin/orders/nodone')}}" method="POST">
			    		{!! csrf_field() !!}
			    		<input type="hidden" name="order_id" value="{{$order->id}}"/>
				    	@if($order->status==1)
				    		<a class="admin-order" href="{{url()}}/order/{{$order->id}}">Đã giao hàng</a>
				    	@else
				    		<a class="admin-order" href="{{url()}}/order/{{$order->id}}">Chưa giao</a>
				    	@endif
			    	</form>
			    </td>
    		</tr>
	    @endforeach
		</tbody>
    </table>
@stop