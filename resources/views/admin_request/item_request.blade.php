<tr style = "margin-bottom: 100px;">
	<td class="item-email">
	    <form action="{{url('setReadStt')}}" method="POST">
	        {!! csrf_field() !!}
	        <input type="hidden" name="request_id" value="{{$request->id}}">
	        <a class="show-content" href="">{{$request->email}}</a>
	    </form>
	</td>
	<td class="created_at">{{$request->created_at}}</td>
	@if($request->already_read==1)
	    <td class="rq_stt">Đã đọc</td>
	    @else
	        <td class="rq_stt">Chưa đọc</td>
	@endif
    <td>
        <form action="{{url('book/undo_delete')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="request_id" value="{{$request->id}}">
            <a class="delete-request" href="">Xóa</a>
        </form>
    </td>
</tr>
<tr>
    <td class="request-content" colspan="4" style="width:100%, text-align:center; padding-left:10px; padding-right:10px;">{!!$request->content!!}</td>
</tr>