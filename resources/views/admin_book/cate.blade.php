<!-- resources/views/auth/register.blade.php -->
@extends('layout.admin')
@section('sidebar')
@include('layout.side-bar-admin')
@stop
@section('title','Đăng bài')
@section('content-title','Đăng bài')
@section('content')
@include('shared.errors_message')
    <table>
        <form method="POST" action="{{url()}}/admin/categories/add" enctype="multipart/form-data">
        {!! csrf_field() !!}
            <tr>
                <td> <label for="">Tên phân nhóm </label></td>
                <td><input type="text" name="category"/></td>
                <td><input class="add-category" type="submit" value="Thêm"/></td>
            </tr>
        </form>
        
    <form method="POST" action="{{url()}}/admin/book_cate/add" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <tr>
            <td>Thêm loại sách</td>
            <td>    <select  name="categories" >
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
            </td>
            <td><input type="text" name="book_cate"/></td>
            <td><input class="add-book-cate" type="submit" value="Thêm"/></td>
            
        </tr>
       </form>
    <form method="POST" action="{{url()}}/admin/categories/update" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <tr>
            <td>Sửa phân nhóm</td>
            <td>    
                    <select  name="categories" >
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
            </td>
            <td><input type="text" name="book_cate"/></td>
            <td><input class="update-category"type="submit" value="Sửa"/></td>
            
        </tr>
       </form> 
    <form method="POST" action="{{url()}}/admin/book_cate/update" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <tr>
            <td>Sửa loại sách</td>
            <td>    
                <select  name="categories" >
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
            <td><input type="text" name="book_cate"/></td>
            <td><input class="update-category"type="submit" value="Sửa"/></td>
        </tr>
       </form> 
    </table>
@stop
