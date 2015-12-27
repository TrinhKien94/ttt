@extends('layout.admin')
@section('content')
<div class="templatemo_content_right">
    <h1>Quản lý yêu cầu khách hàng</h1>
</div>
	<div class="list-books"> 
		@if($requests===1)
			<p>Không có yêu cầu nào</p>
		@else
				<table class="book"  style="border: 1px solid black; width: 100%; word-wrap:break-word;
              table-layout: fixed; margin-bottom:20px;">
				    <thead>
				        <tr class="cart_menu">
				            <td class="item-email">Email</td>
				            <td class="created_at">Ngày đăng</td>
				            <td class="rq_stt">Trạng thái</td>
				            <td class="edit">Xóa</td>
				        </tr>
				    </thead> 
				    <tbody>
			    	@foreach($requests as $request)
			    		@include('admin_request.item_request')
				    @endforeach
					</tbody>
			    </table>

  			{!! $requests->render() !!}
	    @endif
	</div>
@stop