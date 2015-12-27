@extends('layout.admin')
@section('sidebar')
@include('layout.side-bar-admin')
@stop
@section('content')
	<div class="templatemo_content_right">
	    <h1>Quản lý sản phẩm</h1>
	</div>
	<div class="list-books"> 
		@if($books==='1')
			<p>Không có kết quả nào phù hợp</p>
			</div>
		@else
				<table class="book" style = "margin-bottom: 20px;">
				    <thead>
				        <tr class="cart_menu">
				            <td class="item-title">Tên sản phẩm</td>
				            <td class="total">Ngày đăng</td>
				            <td>Trạng thái</td>
				            <td class="edit">Sửa</td>
				            <td class="delete_book">Hành động</td>
				        </tr>
				    </thead> 
				    <tbody>
			    	@foreach($books as $book)
			    		@include('admin_book.item_book')
				    @endforeach
					</tbody>
			    </table>
	    	 </div>
  			{!! $books->appends($request)->render() !!}
	    @endif

@stop