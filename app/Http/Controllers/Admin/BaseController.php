<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController as CommonController;
use App\Http\Requests;
use Cache;
use Config;
use View;


class BaseController extends CommonController
{

    private $menu_key = null;
    private $model = null;

    public $module;
    public $parent_module;

    public function __construct()
    {
//		_log();

        View::share('active', [$this->module => 'active']);
        View::share('parent_active', [$this->parent_module => 'active']);

    }


    public function infoMsg($url, $message = '操作完成')
    {
        echo View('admin.info_msg', compact('url', 'message'));
    }

    public function errorMsg($url, $message = '操作失败')
    {
        echo View('admin.error_msg', compact('url', 'message'));
    }


    //获取控制器
    public function getController($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $controller = substr($controller, 0, stripos($controller, 'Controller'));
        return $controller;
    }


    //菜单缓存
    public function getMenu($status = true)
    {
        if ($status) {
            Cache::forget($this->menu_key);
        }
        if (!Cache::has($this->menu_key)) {
            $menu_list = Config::get('menu.admin');

            Cache::forever($this->menu_key, $menu_list);
        }
        return Cache::get($this->menu_key);
    }


    //刷新缓存
    public function getRefreshCache()
    {
        $this->getMenu(true);

        $message = [
            'message' => '缓存重建完成',
            'url' => url('admin'),
        ];
        return View('admin.info_msg', $message);
    }


}
