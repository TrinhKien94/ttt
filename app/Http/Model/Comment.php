<?php

namespace App\Http\Model;

use App\Http\Model\BaseModel;

class Comment extends BaseModel
{
    public function user(){
    	return $this->belongsTo('App\Http\Model\User');
    }
    public function book(){
        return $this->belongsTo('App\Http\Model\Book');
    }
}
