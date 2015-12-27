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

class AddBookController extends Controller
{
    public function showCreateFrom(){
        if(Auth::user()->role !== 1) return redirect('/');
        return Controller::myView('admin_book.post');
    }
    public function actionCreate(PostCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $bookModel = new BookModel;
        $bookModel->actionCreate($request);
        $this->book = $bookModel->getBook();
        $this->saveImage($request);
        return redirect("/book_info/".$this->book->id);
    }
}
