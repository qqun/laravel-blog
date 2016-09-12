<?php namespace App\Http\Controllers;

use App\Http\Requests;

class CommonController extends Controller
{


//	public function __construct(){
//		_log();
//	}

    public function getController($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $controller = substr($controller, 0, stripos($controller, 'Controller'));
        return $controller;
    }


}
