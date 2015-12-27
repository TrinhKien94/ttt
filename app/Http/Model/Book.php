<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function book_book_cates(){
    	return $this->hasMany('App\Http\Model\Book_book_cate');
    }
    public function orderlines(){
    	return $this->hasMany('App\Http\Model\Orderline');
    }
    public function comments(){
        return $this->hasMany('App\Http\Model\Comment');
    }
}
