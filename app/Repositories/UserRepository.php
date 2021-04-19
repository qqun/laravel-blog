<?php namespace App\Repositories;

use App\Models\Role;
use App\Models\User;

/**
 * 用户仓库UserRepository
 *
 */
class UserRepository extends BaseRepository
{
    /**
     * The Role instance.
     */
    protected $role;

    /**
     * Create a new UserRepository instance.
     *
     * @param User $user
     * @param Role $role
     * @internal param App\Models\Content $content
     */
    public function __construct(
        User $user,
        Role $role)
    {
        $this->model = $user;
        $this->role = $role;
    }

    /**
     * 存储管理型用户
     *
     * @param $manager
     * @param  array $inputs
     * @return
     */
    private function saveManager($manager, $inputs)
    {
        $manager->name = $manager->nickname = e($inputs['name']);
        $manager->password = bcrypt(e($inputs['password']));
        $manager->email = e($inputs['email']);
        $manager->phone = e($inputs['phone']);
        $manager->status = false;
        // $manager->realname = e($inputs['realname']);
        $manager->user_type = 'Manager';  //管理型用户
        // $manager->confirmation_code = md5(uniqid(mt_rand(), true));
        // $manager->confirmed = true;  //确定用户已被验证激活

        // dd($manager);
        if ($manager->save()) {
            $manager->roles()->attach($inputs['role']);  //附加上用户组（角色）
        }

        return $manager;
    }


    /**
     * 更新管理型用户
     *
     * @param $manager
     * @param  array $inputs
     */
    private function updateManager($manager, $inputs)
    {
        $manager->nickname = e($inputs['nickname']);
        $manager->phone = e($inputs['phone']);
        $manager->status = e($inputs['status']);
        // $manager->realname = e($inputs['realname']);
        // $manager->is_lock = e($inputs['is_lock']);
        if ((!empty($inputs['password'])) && (!empty($inputs['password_confirmation']))) {
            $manager->password = bcrypt(e($inputs['password']));
        }
        if ($manager->save()) {

            //确保一个管理型用户只拥有一个角色
            $roles = $manager->roles;
            if ($roles->isEmpty()) {  //判断角色结果集是否为空
                $manager->roles()->attach($inputs['role']);  //空角色，则直接同步角色
            } else {
                if (is_array($roles)) {
                    //如果为对象数组，则表明该管理用户拥有多个角色
                    //则删除多个角色，再同步新的角色
                    $manager->detachRoles($roles);
                    $manager->roles()->attach($inputs['role']);  //同步角色
                } else {
                    if ($roles->first()->id !== $inputs['role']) {
                        $manager->detachRole($roles->first());
                        $manager->roles()->attach($inputs['role']);  //同步角色
                    }
                }
            }
            //上面这一大段代码就是保证一个管理型用户只拥有一个角色
            //Entrust扩展包自身是支持一个用户拥有多个角色的，但在本内容管理框架系统中，限定一个用户只能拥有一个角色
        }
    }

    /**
     * 获取所有角色(用户组)
     *
     */
    public function role()
    {
        return $roles = $this->role->all();
    }

    /**
     * 获取用户角色
     *
     * @param  App\Models\User
     */
    public function getRole($manager)
    {
        return $manager->roles->first();
    }

    /**
     * 伪造一个id为0的Role对象
     *
     */
    public function fakeRole()
    {
        $role = new $this->role;
        $role->id = 0;  //id置为不存在的0
        return $role;
    }

    /**
     * 获取特定id管理员信息
     *
     * @param  int $id
     */
    public function manager($id)
    {
        return $this->model->manager()->find($id);
    }

    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 用户资源列表数据
     *
     * @param  string $type 用户模型类型 管理型用户manager,客户customer
     * @param  array $data 额外传入的参数
     * @param  string $size 分页大小
     * @param  boolean $show_all 是否显示所有客户（不限定专属客服）
     * @return \App\Interfaces\Illuminate\Support\Collection
     */
    public function index($data = [], $type = 'manager', $size = '10', $show_all = false)
    {
        if (!ctype_digit($size)) {
            $size = '10';
        }
        $s_phone = e($data['s_phone']);
        $s_name = e($data['s_name']);

        if ($type === 'manager') {
            $users = $this->model->manager();
            if (!empty($s_phone)) {
                $users = $users->where('phone', '=', $s_phone);
            }
            if(count($data) > 0){
                
                $users = $users->where(function ($query) use ($s_name) {
                        $query->where('name', 'like', '%' . $s_name . '%')
                              ->orWhere('nickname', 'like', '%' . $s_name . '%');
                });
            }
            $users = $users->paginate($size);


        } else {
            $users = $this->model->customer();
            if ($show_all) {
                   $users = $users->where('phone', 'like', '%' . $s_phone . '%');
                    // ->where('realname', 'like', '%'.e($data['s_name']).'%')
                    
            } else {
                $users = $usres->where(function($query) use($s_phone, $s_name, $s_id) {
                    $query->where('phone', 'like', '%' . $s_phone . '%')
                    ->orWhere('realname', 'like', '%' . $s_name . '%');
                });
            }
            $users = $users->orderBy('id', 'desc')->paginate($size);
        }
        return $users;
    }

    /**
     * 存储用户
     *
     * @param  array $inputs
     * @param  string $type 用户模型类型 管理型用户manager,客户customer
     * @param  string|int $user_id 管理用户id
     */
    public function store($inputs = [], $type = 'manager', $user_id = '0')
    {
        $user = new $this->model;
        if ($type === 'manager') {
            $user = $this->saveManager($user, $inputs);
        }
        return $user;
    }


    /**
     * 获取编辑的用户
     *
     * @param  int $id
     * @param  string $type 用户模型类型 管理型用户manager,客户customer
     * @return \App\Interfaces\Illuminate\Support\Collection
     */
    public function edit($id, $type = 'manager')
    {
        if ($type === 'manager') {
            $user = $this->model->manager()->findOrFail($id);
        }
        return $user;
    }

    /**
     * 更新用户
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string 用户模型类型 管理型用户manager,客户customer
     * @return void
     */
    public function update($id, $inputs, $type = 'manager')
    {
        if ($type === 'manager') {
            $user = $this->model->manager()->findOrFail($id);
            $user = $this->updateManager($user, $inputs);
        }
        return;
    }


    public function profile($id, $inputs = [])
    {
        return $this->model->where('id', $id)->update($inputs);
    }


    /**
     * 获取某ID用户
     * @param $id
     * @return mixed
     */
    public function getUserInfoById($id)
    {
        return $this->model
            ->select('id', 'name', 'nickname', 'avatar', 'email', 'remark')
            ->find($id);
    }


}
