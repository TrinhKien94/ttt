<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateBookCateCheck extends Request
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
            "book_cate"=>"required",
            'categories'=>'required|numeric|between:1,100',
        ];
    }
}
