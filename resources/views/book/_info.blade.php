@extends('layout.default')
@section('content-title')
{{$book->title}}
@stop
@section('title')
{{$book->title}}
@stop
@section('content')

        
<div id="templatemo_content_right">
    @if($book->image!=='')
        <div class="image_panel"><img src="{{ url() }}/{{$book->image}}" alt="image" width="160px" height="240" /></div>
    @else
        <div class="image_panel"><img src="{{ url() }}/images/none.png" alt="image" width="160px" height="240" /></div>    
    @endif
    <h2>Read the lessons - Watch the videos - Do the exercises</h2>
    <ul>
        <li><h2>Tác giả: <a href="#">{{$book->author}}</a></h2></li>
    	<li><h2>Ngày xuất bản: {{$book->created_at}}</h2></li>
        <li><h2>Lượt xem: {{$book->views}}</h2></li>
        <li><h2>Số lượng: {{$book->quantity}}</h2></li>
        <li><h2>Price: {{$book->price}}.000 VNĐ</h2></li>
    </ul>
    @if($book->deleted!=1)
        <form action="{{url()}}/order" method="POST" class="buy-form" >
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="add_to_cart_button">
                        Add to cart
                    </button>
                    <button type="submit" class="buy_now_button">
                        Buy now
                    </button>
        </form>
        @else
            <h3 style="color:red;">Sách này đã bị xóa</h3>
    @endif
   <div class="description" ><h3 class="t_name3">Giới thiệu</h3>{!!$book->description!!}</div>
    
     <div id="1" class="cleaner_with_height">&nbsp;</div>
     <h3 >Bình luận:</h3>
     <div class="comment-list">
    @foreach($comments as $comment)
        <div class="comment-item">
        	<div class="comment-head">
        		<div class="comment-time" style="width:300px;float:left;">{{$comment->created_at}}</div>
        		<div style="float:right;"><a id="{{$comment->id}}">#</a></div>
        	</div>
            <div class="person-comment-info">
            {{--*/ $user=$comment->user/*--}} 
                <p>Username: {{$user->username}}</p>
                <p>Phone: {{$user->phone}} </p>
                <p>Email: {{$user->email}}</p>
            </div>
            <div class="comment-content">
            	{!!$comment->content!!}
            </div>
        </div>
    @endforeach
    </div>
	<div class="paginate-comment">{!! $comments->render() !!} </div>
     @if(Auth::check())
        <form action="{{url()}}/book/comment" method="POST" style="margin-top:30px; display:inline-block;">
        {!! csrf_field() !!}
            <textarea  type="text" rows="5" cols="60" name="comment" style="display:block;"></textarea>
            <input class="post-comment" type="submit" value="Gửi bình luận" class="comment" />
            <input type="hidden" value="{{$book->id}}" name="book_id" />
        </form>
        <p id = "comment-error" style="color:red;"></p>
     @endif                
</div> <!-- end of content right -->
    
@stop