<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Redirect;

class RoleController extends BaseController
{

    protected $role;

    public function __construct(RoleRepository $role)
    {
        parent::__construct();
        $this->role = $role;

        if (!user('object')->can('manage_users')) {
            // $this->middleware('deny403');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $role = Role::paginate(Config::get('site.page_count'));

        $data = $this->role->index();
        return View('admin.user.role', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = $this->role->permission();
        $cans = [];
        return View('admin.user.role_create', compact('permissions', 'cans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $role = $this->role->store($data);
        if ($role->id) {
            return Redirect::to('admin/roles')->with('message', '成功新增角色');
        } else {
            return Redirect::back()->withInput($request->input())->with('fail', '数据库操作异常');
        }
        /*
        $this->validator($request, [
            'name' => 'required|max:200',
            ]);
        $role = new Role();
        $role->name = trim(Input::get('name'));
        $role->display_name = trim(Input::get('display_name'));
        $role->description = Input::get('description');

        if($role->save()){
            return Redirect::to('admin/role');
        }else{
            return Redirect::back()->withInput();
        }
        */
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
        // $role = Role::find($id);
        $role = $this->role->edit($id);
        $permissions = $this->role->permission();
        $cans = $this->role->getRoleCans($role);

        return View('admin.user.role_edit', compact('role', 'permissions', 'cans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->all();
        $this->role->update($id, $data);
        return Redirect::to('admin/roles')->with('message', '修改角色成功');
        /*
        $role = Role::find($id);
        $role->name = trim(Input::get('name'));
        $role->display_name = trim(Input::get('display_name'));
        $role->description = trim(Input::get('description'));

        if($role->save()){
            return Redirect::to('admin/role');
        }else{
            return Redirect::back()->withInput()->withError('Error');
        }
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->role->destroy($id);
        return Redirect::to('admin/roles')->with('message', '删除角色成功');
    }

}
