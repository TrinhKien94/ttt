<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class BaseModel extends Model
{
    public function getUpdatedAtAttribute(){
    	return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }
    public function getcreatedAtAttribute(){
    	return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i:s');
    }
}