<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EditorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	public function ueditor()
	{
        $data = [
            'content'=>'我是数据内容Ueditor',
            'dat'=> htmlspecialchars( "<p>我是富<br/>文本内容Ueditor</p>"),
        ];
		return View('ueditor', compact('data'));
	}


	public function ckeditor()
	{
		// dd($_SERVER);

		$data = [
            'content'=>'我是数据内容Ckeditor',
            'dat'=> htmlspecialchars( "<p>我是富<br/>文本内容Ckeditor</p>"),
        ];
        // dd($data);
		return View('ckeditor', compact('data'));
	}


	public function ue()
	{
		$data = [
            'content'=>'我是数据内容Ckeditor',
            'dat'=> htmlspecialchars( "<p>我是富<br/>文本内容Ckeditor</p>"),
        ];
        // dd($data);
		return View('ue', compact('data'));
	}

}
