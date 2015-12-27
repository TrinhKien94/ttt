<tr style = "margin-bottom: 100px;">
	<td class="item-title"><a href="{{url()}}/book_info/{{$book->id}}">{{$book->title}}</a></td>
	<td>{{$book->created_at}}</td>
	@if($book->deleted==1)
	    <td class="book_stt">Đã xóa</td>
	    @else
	        <td class="book_stt">Chưa xóa</td>
	@endif
    <td>
            <a href="{{url()}}/admin/book/edit/{{$book->id}}">Sửa</a>
    </td>
    <td>
        <form action="{{url('book/undo_delete')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="book_id" value="{{$book->id}}">
            @if($book->deleted!=1)
                <a class="delete-book" href="">Xóa</a>
            @else
                <a class="delete-book" href="">Hoàn tác</a>
            @endif
        </form>
    </td>
</tr>