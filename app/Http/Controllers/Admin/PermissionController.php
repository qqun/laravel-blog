<?php namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Config;

class PermissionController extends BaseController
{

    protected $role;

    public function __construct(RoleRepository $role)
    {
        parent::__construct();
        $this->role = $role;

        // if (! user('object')->can('manage_users')) {
        //           $this->middleware('deny403');
        //       }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$this->role->permission()
        $data = Permission::paginate(Config::get('site.page_count'));;
        return View('admin.user.permission', compact('data'));
    }


}
