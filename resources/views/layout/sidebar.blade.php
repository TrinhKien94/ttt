<div id="templatemo_content_left">
    <div class="templatemo_content_left_section">
    	<h1>Loại sách</h1>
        <ul>
            @foreach($categories as $category)
            <li><a class="parent">{{$category->name}}</a>
                <ul class="submenu">
                {{--*/ $book_cates=$category->book_cates /*--}}
                @foreach($book_cates as $book_cate)
                    <li><a href="{{ url() }}/book_cate/{{$book_cate->id}}">{{$book_cate->name}}</a></li>
                @endforeach
                </ul>
            </li>    
            @endforeach    
    	</ul>
    </div>
    <div class="templatemo_content_left_section">
    	<h1>Sách bán chạy</h1>
        <ul>
            <li><a href="#">Sách bán chạy</a></li>
    	</ul>
    </div>
    <div class="templatemo_content_left_section">
        <h1>Yêu cầu sách</h1>
        <form action="/request" method="POST" style=" display:inline-block;">
        {!! csrf_field() !!}
            <p>Email:</p>
            <input type="text" name="email" style="width:97%;"/>
            <p id="email-error" style="color:red;"></p>
            <p>Yêu cầu:</p>
            <textarea  type="text" rows="10" cols="21" name="content" style="display:block;"></textarea>
            <p id="request-error" style="color:red;"></p>
            <input type="submit" value="Gửi yêu cầu" class="request" />
        </form>
    </div>

</div> <!-- end of content left -->
