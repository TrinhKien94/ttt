<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Model\BookModel;
use App\Http\Model\Book;
use App\Http\Model\Category;
use App\Http\Model\Book_cate;
use App\Http\Requests\PostCheck;
use App\Http\Requests\UpdateCheck;
use App\Http\Requests\UpdateCategoryCheck;
use App\Http\Requests\UpdateBookCateCheck;

class EditBookController extends Controller
{
    public function showUpdateForm($id){
        if(Auth::user()->role !== 1) return redirect('/');
        $this->book = book::where('id','=',$id)->first();
        $book_book_cates = $this->book->book_book_cates;
        $i = 0;
        $cates= array();
        $book_cates =array();
        $book_cate_ids = array();
        foreach($book_book_cates as $book_book_cate){
            $book_cate=$book_book_cate->book_cate;
            $book_cates[$i]= $book_cate->name;
            $book_cate_ids[$i]=$book_cate->id;
            $cate= $book_cate->category;
            $cates[$i]=$cate->name;
            $i++;
        }
        return Controller::myView('admin_book.update')->with("book",$this->book)->with("cates",$cates)
        ->with("book_cate_names",$book_cates)->with("book_cate_ids",$book_cate_ids);
    }
    public function actionUpdate(UpdateCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        // return $request->input('book_id');
        $bookModel = new BookModel;
        $bookModel->actionUpdate($request);
        $this->book = $bookModel->getBook();
        $this->saveImage($request);
        return redirect("/book_info/".$this->book->id);   
    }
}
