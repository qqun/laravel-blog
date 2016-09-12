<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TestController extends CommonController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permission = parent::getController(get_class()).'_'.__FUNCTION__;
		dd($permission);


        //        //当前类名
//        $yy =  (new \ReflectionClass(get_class()))->getShortName() ;



//        //创建角色
//        $user = new Role();
//        $user -> name = "管理员";
//        $user->display_name="还是管理员";
//        $user->description="也是管理员的啦";
//        $user->save();
//
//        //创建角色
//        $admin = new Role();
//        $admin->name = "Admin";
//        $admin->display_name = "User Administrator";
//        $admin->description = "manager and edit other users";
//        $admin->save();

//        //创建权限
//        $managerUsers = new Permission();
//        $managerUsers->name = 'Manager_users';
//        $managerUsers->display_name = 'Manager Users';
//        $managerUsers->save();
        //多个权限对应一个角色， 一个角色对应一个用户


        //设置权限
//        $admin = Role::where('name','Admin')->first();
//        $permission = Permission::where('name','Manager_users')->first();
//        $admin->attachPermission($permission);
//        echo "done";

        //设置角色
//        $user = User::where('name','=','admin')->first();
//        $admin = Role::where('name','Admin')->first();
//        $user->attachRole($admin);
//        //or
//        $user->roles()->attach(1);




//        $user = User::where('name','=','admin')->first();
//        $user->perms()->sysnc(1);


//        $admin = Role::where('name','Admin')->first();
//        $admin->perms()->sync(array(1));



//        die();



        $user = User::where('name','=','admin')->first();

        //判断角色
        if($user->hasRole('管理员'))
            echo "Yes";




        //判断权限
        if($user->can('Manager_users'))
            echo "EnEn";

        if(\Auth::user()->hasRole('Admin'))
            echo "X00";

        echo "Done";

        die();


	}

    public function add(){
        return View::make('new');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//        dd('x');

		if(Session::token() !== Input::get( '_token' ) ){
            return Response::json( [
                'msg'=>'Unauthorized attempt to create test'
            ] );
        }
        $setting_name = Input::get( 'setting_name' );
        $setting_value = Input::get( 'setting_value' );

        //validate data
        //then store it in DB

        $response = [
            'status'=>'success',
            'msg'=>'Setting Created successfully'
        ];


        return Response::json($response);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
