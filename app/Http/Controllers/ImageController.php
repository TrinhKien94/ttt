<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
	public $destination;
	public $filename;
	public function create($image,$id){
		$extension = $image->getClientOriginalExtension();
		$this->filename = $id.'.'.$extension;
		$image->move($this->destination,$this->filename);
	}
	public function setDestination($destination){
		$this->destination=$destination;
	}
	public function getDestination(){
		return $this->destination;
	}
}
