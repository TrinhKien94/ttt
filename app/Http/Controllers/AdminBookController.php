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
class AdminBookController extends Controller
{
    public function admin_books()
    {
        if(Auth::user()->role !== 1) return redirect('/');        
        return Controller::myView('admin_book.admin_books');
    }
    //
    public function search_book(Request $request)
    {
        if(Auth::user()->role !== 1) return redirect('/');
        $bookController = new BookController;
        $books = $bookController->search($request);
        $check=$books->first();
        if ( is_null($check) ) {
            return Controller::myView('admin_book.books')->with('books', '1');
        }
        $books=$books->paginate(15);
        $books->setPath('/admin_books/result');
        $data=$bookController->saveRequest($request);
        $data['books']=$books;
        return Controller::myView('admin_book.books')->with($data);       
    }
    //
    public function delete_book(Request $request)
    {
        if(Auth::user()->role !== 1) return redirect('/');
        $book = Book::find((int)$request->input('book_id'));
        $book->deleted=1;
        $book->save();
    }
    public function undo_delete(Request $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $book = Book::find((int)$request->input('book_id'));
        $book->deleted=0;
        $book->save();
    }
    
    public function showCreateFrom(){
        if(Auth::user()->role !== 1) return redirect('/');
        return Controller::myView('admin_book.post');
    }
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
    public function actionCreate(PostCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $bookModel = new BookModel;
        $bookModel->actionCreate($request);
        $this->book = $bookModel->getBook();
        $this->saveImage($request);
        return redirect("/book_info/".$this->book->id);
    }
    private function saveImage($request){
        if(!is_null($request->file('image'))){
            $imageController = new ImageController;
            $imageController->setDestination("images");
            $imageController->create($request->file('image'),$this->book->id);        
            $this->book->save();
        }
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
    public function showCateUpdate(){
        if(Auth::user()->role !== 1) return redirect('/');
        return Controller::myView('admin_book.cate');
    }
    public function addCategory(UpdateCategoryCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $category = new Category;
        $category->name = $request->input('category');
        $category->save();
        return redirect('/admin/categories');
    }
    public function addBookCate(UpdateBookCateCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $category = new Book_cate;
        $category->name = $request->input('book_cate');
        $category->category_id =(int)$request->input('categories');
        $category->save();
        return redirect('/admin/categories');        
    }
    public function updateBookCate(UpdateBookCateCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $category = Book_cate::find((int)$request->input('categories'));
        $category->name = $request->input('book_cate');
        $category->save();
        return redirect('/admin/categories');        
    }
    public function updateCategory(UpdateBookCateCheck $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $category = Category::find((int)$request->input('categories'));
        $category->name = $request->input('book_cate');
        $category->save();
        return redirect('/admin/categories');        
    }
}
