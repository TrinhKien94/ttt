<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Book;
use App\Http\Model\Book_cate;
use App\Http\Model\Book_book_cate;
class BookController extends Controller
{
	public function book_info($id)
	{
		$book = Book::findOrFail($id);
		$book->views +=1;
		$book->save();
		$comments=$book->comments()->orderBy('id', 'DESC')->paginate(10);
		return Controller::myView('book._info')->with('book', $book)->with('comments',$comments);
	}

	public function book_cate($id){
        $book_cate= Book_cate::findOrFail($id);
        $book_book_cates = $book_cate->book_book_cates()->paginate(6);
        $book_book_cates->setPath('/book_cate/'.$id);
        $data = array('book_book_cates'=>$book_book_cates,'category'=>$book_cate->category->name,'book_cate_name'=>$book_cate->name);
        return Controller::myView('book._show_by_cate',$data);
	}

    public function index()
    {
    	$books = Book::where('views', '>', 400 )->paginate(6);
        return Controller::myView('book._index')->with('books', $books);
    }

    public function searchForm(){
        return Controller::myView('book.search');
    }
// luu cai request o dau ????
    public function searchResult(Request $request){
        $data = $this->saveRequest($request);
        $books = $this->search($request);
        $books=$books->where('deleted','=',0);
    	$check=$books->first();
    	if ( is_null($check) ) {
    		return Controller::myView('book.search_result')->with('books', '1');
    	}
    	$books=$books->paginate(6);
    	$books->setPath('/search/result');
    	$data['books']=$books;
        return Controller::myView('book.search_result')->with($data);
    }
    public function saveRequest($request){
    	$data_request['search_text']=$request->input('search_text');
    	$data_request['price']=$request->input('price');
    	$data_request['author']=$request->input('author');
    	$data_request['title']=$request->input('title');
    	$data_request['check_author']=$request->input('check_author');
    	$data_request['check_price']=$request->input('check_price');
    	$data_request['check_category']=$request->input('check_category');
    	$data_request['categories']=$request->input('categories');
    	$data_request['book_status']= $request->input('book_status');
    	$data_request['deleted'] = $request->input('deleted');
    	$data['request'] = $data_request;
    	return $data;
    }
    public function search($request){
    	$books=Book::where('title', 'like', "%".$request->input('search_text')."%" );
    	if(null !==$request->input('check_author')){
    		$books= $books->where('author','like', "%".$request->input('author')."%");
    	}
    	if(null != $request->input('check_category')){
    		$books=$books->join('book_book_cates','books.id','=','book_book_cates.book_id')->where('book_book_cates.book_cate_id','=',(int)$request->input('categories'));	
    	}
    	if(null !==$request->input('check_price')){
    		if ($request->input('price')==="0")
    			$books = $books->where('price','<',20);
    		else if($request->input('price')==="1")
    			$books = $books->where('price','>=',20)->where('price','<=',50);
    		else if($request->input('price')==="2")
    			$books = $books->where('price','>=',50)->where('price','<=',100);
    		else if($request->input('price')==="3")
    			$books = $books->where('price','>',100);
    	}
    	if(null !== $request->input('book_status')){
    	    if($request->input('deleted')==="0")
    	        $books = $books->where('deleted','=',0);
    	    else if($request->input('deleted')==="1")
    	        $books = $books->where('deleted','=',1);
    	}
    	return $books;
    }
}
