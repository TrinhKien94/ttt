<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostCheck extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //production post
            'title'=>'required|between:1,255',
            'quantity'=>'required|numeric|between:1,30',
            'author'=>'required',
            'image'=>'image|mimes:jpeg,jpg,png,bmp,gif,svg',
            'price'=>'required|numeric|between:1,1000',
            'categories'=>'required|numeric|between:1,100',
            'description'=>'required|between:1,1000'
        ];
    }
}
