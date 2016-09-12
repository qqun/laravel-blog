<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\UserRepository;

class AboutController extends BaseController
{

    private $_user;

    public function __construct(
        UserRepository $user
    )
    {
        parent::__construct();
        $this->_user = $user;
    }

    public function index()
    {
        $id = 1;
        echo self::show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        if($id == 0){
            exitJson(9,'找不到对应文章');
        }
        // 获取用户信息
        // 获取当前用户文章信息
        $user = $this->_user->getUserInfoById($id);

        return View('home.about', compact('user'));
    }


}
