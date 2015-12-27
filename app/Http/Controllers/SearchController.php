<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Book;
use App\Http\Model\Book_cate;
use App\Http\Model\Book_book_cate;
use App\Http\Model\SearchModel;
class SearchController extends Controller
{
    public function searchForm(){
        return Controller::myView('book.search');
    }

    public function searchResult(Request $request){
        $data = $this->saveRequest($request);
        $search = new SearchModel;
        $books = $search->search($request);
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
}
