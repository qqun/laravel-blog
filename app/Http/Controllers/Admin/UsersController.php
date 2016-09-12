<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersController extends BaseController
{


    protected $user;


    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;

        //权限判断
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $permission = parent::getController(get_class()).'_'.__FUNCTION__;
        // $user = \Auth::user();
        // if(!$user->can($permission))
        // 	return View('admin.msg', compact(''));
        // $user = User::where('id',$user->id)->paginate(10);

        $program = [
            's_name' => $request->input('s_name'),
            's_phone' => $request->input('s_phone'),
        ];
        $data = $this->user->index($program, 'manager',
            Cache::get('page_size', '10'));

//        dd($user);

        return View('admin.user.user', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->user->role();
//        dd($roles);
        return View('admin.user.user_create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $manager = $this->user->store($data, 'manager');
        if ($manager->id) {
            _log('新增管理员' . $manager->name . '(' . $manager->email . ')');
            return Redirect::to('admin/users')
                ->with('message', '成功添加管理员');
        } else {
            return Redirect::back()->withInput($request->input())
                ->with('fail', '系统操作异常，请联系超级管理员');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $roles = $this->user->role();
        $user = $this->user->edit($id, 'manager');

        //虽然Entrust支持一个用户多个角色用户组，但在本内容管理框架系统中，限定只能一个用户对应一个角色用户组
        $own_role = $this->user->getRole($user);

        if (is_null($own_role)) {
            //新建的管理员用户可能不存在关联role模型
            //伪造一个Role对象，以免报错
            $own_role = $this->user->fakeRole();
        }
        return View('admin.user.user_edit',
            compact('roles', 'user', 'own_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        $this->user->update($id, $data, 'manager');

        return Redirect::to('admin/users')
            ->with('message', '修改管理员资料成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->user->destroy($id)) {
//        if(true){
            _log('删除管理员ID:' . $id);
            $message = ['message' => '删除成功', 'url' => URL('admin/users')];
            return View('admin.info_msg', $message);
//            return Redirect::to('admin/users')->with('message','删除用户成功');
        } else {
            $message = ['message' => '删除失败', 'url' => URL('admin/users')];
            return View('admin.error_msg', $message);
        }

    }


    /**
     * 更新个人信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {

        //TODO:: 更新资料

        if ($_POST) {
            $request = $_REQUEST;
            $id = \Auth::user()->id;
            $user = [
                'name' => \Auth::user()->name,
                'password' => $request['password_origin'],
            ];

            //判断原密码
            if (\Auth::attempt($user)) {
                if ($request['password_new'] == $request['password_confirmation']
                    && trim($request['password_new']) != ''
                ) {
                    $password = Hash::make(trim($request['password_new']));
                    //TODO：： 更新密码
                    $result = $this->user->changePassword($id, $password);
                    if ($result) {
                        $this->infoMsg(url('admin/profile'), "密码更新成功。");
                    } else {
                        $this->errorMsg(url('admin/profile'), "密码更新失败，请联系管理员。");
                    }

                } else {
                    $this->errorMsg(url('admin/profile'), "新密码校验失败！");
                }
            } else {
                $this->errorMsg(url('admin/profile'), "旧密码校验失败！");
            }

            //校验新密码
//			Hash::make('123456');


            dd($request);
        } else {
            $user = \Auth::user();
            return View('admin.user.profile', compact('user'));
        }
    }

}
