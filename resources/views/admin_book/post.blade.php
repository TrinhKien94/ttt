<!-- resources/views/auth/register.blade.php -->
@extends('layout.admin')
@section('sidebar')
@include('layout.side-bar-admin')
@stop
@section('title','Đăng bài')
@section('content-title','Đăng bài')
@section('content')
@include('shared.errors_message')
<form method="POST" action="{{url()}}/admin/book/post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <table >
         <tr>
            <td>Tên sách <span style="color:red;">*</span></td>
            <td><input type="text" size="30" name='title' value="{{ old('title') }}" /></td>
        </tr>
        <tr>
            <td>Tên tách giả <span style="color:red;">*</span></td>
            <td><input type="text" size="30" name='author' value="{{ old('author') }}" /></td>
        </tr>
        <tr>
            <td>Loại sản phẩm 1<span style="color:red;">*</span></td>
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
            <td><input type='number' id="quantity" class='quantity_input'size='10' min="1" max="30" name='quantity' value= "{{old('quantity')}}" /></td>
        </tr>
        <tr>
            <td>Giá bán <span style="color:red;">*</span></td>
            <td><input type='number' id="price" class='quantity_input'size='10' min="1" max="1000" name='price' value= "{{old('price')}}" />.000 VNĐ</td>
        </tr>
        <tr>
            <td>Ảnh sản phẩm</td>
            <td>{!!Form::file('image',['class'=>'file'])!!}</td>
        </tr>
        <tr>
            <td>Mô tả <span style="color:red;">*</span></td>
            <td colspan="2"><textarea  type="text" rows="15" cols="60" name="description" >{{ old('description') }}</textarea></td>
        </tr>
        <tr>
            <td><h2><input class="comment" type="submit" value="Hoàn Tất" name="singup"  /></h2></td>
        </tr>

    </table>

</form>
@stop