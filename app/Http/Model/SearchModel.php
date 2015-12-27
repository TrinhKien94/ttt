<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SearchModel extends Model
{
    private $book;
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
