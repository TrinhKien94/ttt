<!-- resources/views/auth/register.blade.php -->
@extends('layout.admin')
@section('sidebar')
@include('layout.side-bar-admin')
@stop
@section('title','Đăng bài')
@section('content-title','Đăng bài')
@section('content')
@include('shared.errors_message')
<form method="POST" action="{{url()}}/admin/book/update" enctype="multipart/form-data">
    {{--*/ $size=count($cates) /*--}}
    <table >
         <tr>
            <td>Tên sách <span style="color:red;">*</span></td>
            <td><input type="text" size="30" name='title' value="{{ $book->title }}" /></td>
        </tr>
        <tr>
            <td>Tên tách giả <span style="color:red;">*</span></td>
            <td><input type="text" size="30" name='author' value="{{ $book->author }}" /></td>
        </tr>
        <tr>
            <td>Loại sản phẩm 1<span style="color:red;">*</span></td>
            <td>{{$cates[0]}} > {{$book_cate_names[0]}}</td>
            <input type="hidden" name="old-categories" value="{{$book_cate_ids[0]}}"/>
            <td>
                <select  name="categories" >
                <optgroup>
                <option value="0" selected="selected">Chọn loại sách...</option>
                </optgroup>
                @foreach($categories as $category)
                <optgroup label="{{$category->name}}">
                  {{--*/ $book_cates=$category->book_cates /*--}}
                  @foreach($book_cates as $book_cate)
                     <option value="{{$book_cate->id}}">{{$book_cate->name}}</option>
                  @endforeach
                </optgroup>
                @endforeach
                </select>
            </td>
        </tr>
        <tr class="categories1">
            <td>Loại sản phẩm 2</td>
            @if($size>=2)
                <td>{{$cates[1]}} > {{$book_cate_names[1]}}</td>
                <input type="hidden" name="old-categories1" value="{{$book_cate_ids[1]}}"/>
            @endif
            <td>
                <select  name="categories1" >
                <optgroup>
                <option value="0" selected="selected">Chọn loại sách...</option>
                </optgroup>
                @foreach($categories as $category)
                <optgroup label="{{$category->name}}">
                  {{--*/ $book_cates=$category->book_cates /*--}}
                  @foreach($book_cates as $book_cate)
                     <option value="{{$book_cate->id}}">{{$book_cate->name}}</option>
                  @endforeach
                </optgroup>
                @endforeach
                </select>
            </td>
        </tr>
        <tr class="categories1">
            <td>Loại sản phẩm 3</td>
            @if($size>=3)
                <td>{{$cates[2]}} > {{$book_cate_names[2]}}</td>
                <input type="hidden" name="old-categories2" value="{{$book_cate_ids[2]}}"/>
            @endif
            <td>
                <select  name="categories2" >
                <optgroup>
                <option value="0" selected="selected">Chọn loại sách...</option>
                </optgroup>
                @foreach($categories as $category)
                <optgroup label="{{$category->name}}">
                  {{--*/ $book_cates=$category->book_cates /*--}}
                  @foreach($book_cates as $book_cate)
                     <option value="{{$book_cate->id}}">{{$book_cate->name}}</option>
                  @endforeach
                </optgroup>
                @endforeach
                </select>
            </td>
        </tr>
        <tr class="categories1">
            <td>Loại sản phẩm 4</td>
            @if($size>=4)
                <td>{{$cates[3]}} > {{$book_cate_names[3]}}</td>
                <input type="hidden" name="old-categories3" value="{{$book_cate_ids[3]}}"/>
            @endif
            <td>
                <select  name="categories3" >
                <optgroup>
                <option value="0" selected="selected">Chọn loại sách...</option>
                </optgroup>
                @foreach($categories as $category)
                <optgroup label="{{$category->name}}">
                  {{--*/ $book_cates=$category->book_cates /*--}}
                  @foreach($book_cates as $book_cate)
                     <option value="{{$book_cate->id}}">{{$book_cate->name}}</option>
                  @endforeach
                </optgroup>
                @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Số lượng <span style="color:red;">*</span></td>
            <td><input type='number' id="quantity" class='quantity_input'size='10' min="1" max="30" name='quantity' value= "{{$book->quantity}}" /></td>
        </tr>
        <tr>
            <td>Giá bán <span style="color:red;">*</span></td>
            <td><input type='number' id="price" class='quantity_input'size='10' min="1" max="1000" name='price' value= "{{$book->price}}" />.000 VNĐ</td>
        </tr>
        <tr>
            <td>Ảnh sản phẩm</td>
            <td>{!!Form::file('image',['class'=>'file'])!!}</td>
        </tr>
        <tr>
            <td>Mô tả <span style="color:red;">*</span></td>
            <td colspan="2"><textarea  type="text" rows="15" cols="60" name="description" >{{ $book->description }}</textarea></td>
        </tr>
        <tr>
            <td><h2><input class="comment" type="submit" value="Hoàn Tất" name="singup"  /></h2></td>
        </tr>
      <input type="hidden" name="book_id" value="{{$book->id}}"/>
    </table>
{!! csrf_field() !!}
</form>
@stop