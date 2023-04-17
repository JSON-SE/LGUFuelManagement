<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'sku' => 'required',
            'default_width' => 'required|integer',
            'default_height' => 'required|integer',
            'slug' => "required|max:250|unique:products,external_id,$id",
            'excerpt' => 'max:250',
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.',
            'name.required' => 'Product name Is Required.',
//            'display_media_id.required' => 'Display Image Is Required.',
        ];

        $this->validate($request, $rules, $customMessages);
    }
}
