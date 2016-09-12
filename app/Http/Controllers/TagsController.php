<?php

namespace App\Http\Controllers;


use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index(Request $request){
//        $request = $_REQUEST;
        $data = $request->all();
        $v = trim($data['tags']);
        $v = preg_replace('/\s/',"",$v);
        $tag_temp = Tags::where('name',$v)->first();
        if($tag_temp){
            echo json_encode(['id'=>$tag_temp->id,'name'=>$tag_temp->name]);
        }else{
            $id = Tags::insertGetId(['name'=>$v]);
            echo json_encode(['id'=>$id,'name'=>$v]);
        }
    }

}
