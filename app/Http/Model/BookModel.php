<?php

namespace App\Http\Model;

use App\Http\Model\Book;
use App\Http\Model\Book_book_cate;
use Auth;
class BookModel
{
    private $book;
    public function getBook(){
        return $this->book;
    }
	public function actionDelete($request){
        $this->book = Book::find((int)$request->input('book_id'));
        $this->book->delete();
	}
	public function actionUpdate($request){
        $this->book= Book::find((int)$request->input('book_id'));
        return $this->changeUpdate($this->book,$request);
	}	    
	public function actionCreate($request){
        $this->book= new Book;
        $this->book->views=0;
        $this->changeCreate($this->book,$request);
	}
	private function changeCreate($book,$request){ 
	    $this->book = new Book;
        $this->book->title=$request->input('title');
        $this->book->author=$request->input('author');
        $this->book->quantity=(int)$request->input('quantity');
        $this->book->price =(int)$request->input('price');
        $this->book->description=preg_replace("/\r\n|\r/", "<br />", $request->input('description'));
        $this->book->deleted=0;
        $this->book->save();
        if(!is_null($request->file('image'))){
            $extension = $request->file('image')->getClientOriginalExtension();
            $this->book->image="images/".$this->book->id.".".$extension;      
            $this->book->save();
        }
        if((int)$request->input('categories')!=0){
            $this->book_book_cate= new Book_book_cate;
            $this->book_book_cate->book_cate_id=$request->input('categories');
            $this->book_book_cate->book_id=$this->book->id;
            $this->book_book_cate->save();
        }
        if((int)$request->input('categories1')!=0 && 
         $request->input('categories1')!=null &&
         $request->input('categories1') != $request->input('categories')){
             
            $this->book_book_cate = new Book_book_cate;
            $this->book_book_cate->book_cate_id=$request->input('categories1');
            $this->book_book_cate->book_id=$this->book->id;
            $this->book_book_cate->save();
        }
        if((int)$request->input('categories2')!=0 && 
         $request->input('categories2')!=null &&
         $request->input('categories2') != $request->input('categories1') &&
         $request->input('categories2') != $request->input('categories')){
            $this->book_book_cate = new Book_book_cate;
            $this->book_book_cate->book_cate_id=$request->input('categories2');
            $this->book_book_cate->book_id=$this->book->id;
            $this->book_book_cate->save();
        }
        if((int)$request->input('categories3')!=0 && 
         $request->input('categories3')!=null &&
         $request->input('categories3') != $request->input('categories2') &&
         $request->input('categories3') != $request->input('categories1') &&
         $request->input('categories3') != $request->input('categories')){
            $this->book_book_cate = new Book_book_cate;
            $this->book_book_cate->book_cate_id=$request->input('categories3');
            $this->book_book_cate->book_id=$this->book->id;
            $this->book_book_cate->save();
        }
	}
	private function changeUpdate($book,$request){ 
	    $this->book = Book::where('id','=',(int)$request->input('book_id'))->first();
        $this->book->title=$request->input('title');
        $this->book->author=$request->input('author');
        $this->book->quantity=(int)$request->input('quantity');
        $this->book->price =(int)$request->input('price');
        $this->book->description=preg_replace("/\r\n|\r/", "<br />", $request->input('description'));
        $this->book->deleted=0;
        $this->book->save();        
        $old = array();
        $old[0] = (int)$request->input('old-categories');
        if($request->input('old-categories1')!==null)
        $old[1] = (int)$request->input('old-categories1');
        if($request->input('old-categories2')!==null)
        $old[2] = (int)$request->input('old-categories2');
        if($request->input('old-categories3')!==null)
        $old[3] = (int)$request->input('old-categories3');
        $new =array();
        if($request->input('categories')!==0)
            $new[0] = (int)$request->input('categories');
        else 
            $new[0] = 0;
        if($request->input('categories1')!==0)
            $new[1] = (int)$request->input('categories1');
        else 
            $new[1] = 0;
        if($request->input('categories2')!==0)
            $new[2] = (int)$request->input('categories2');
        else 
            $new[2] = 0;
        if($request->input('categories3')!==0)
            $new[3] = (int)$request->input('categories3');
        else 
            $new[3] = 0;
        for($i=0;$i<count($new);$i++){
            if($new[$i]!=0){
                if(isset($old[$i])){
                    $book_book_cate = Book_book_cate::where('book_id','=',$this->book->id)->where('book_cate_id','=',$old[$i])->first();
                }else{
                    $book_book_cate = new Book_book_cate;
                    $book_book_cate->book_id=$this->book->id;
                }
                $old[$i]= $new[$i];
                $book_book_cate->book_cate_id=$new[$i];
                $book_book_cate->save();
            }
        }
        for($i=0;$i<count($old)-1;$i++){
            for($j=$i+1;$j<count($old);$j++){
                if(isset($old[$j])){
                    if($old[$i]==$old[$j]){
                        $book_book_cate = Book_book_cate::where('book_id','=',$this->book->id)->where('book_cate_id','=',$old[$i])->first();
                        $book_book_cate->delete();
                    }
                }
            }
        }
	}
	
	
}
