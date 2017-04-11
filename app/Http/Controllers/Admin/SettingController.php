<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\SystemRepository;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    private $_system;

    public function __construct(
        SystemRepository $sys
    )
    {
        parent::__construct();
        $this->_system = $sys;

//        dd($sys->getSystemCache());
        if (!user('object')->can('manage_setting')) {
            // $this->middleware('deny403');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($_POST) {
            $inputs = $request->all();
            $inputs['thumb'] = array_filter($inputs['thumb']);
            $inputs['thumb'] = implode(',', $inputs['thumb']);
            $this->_system->update(0, $inputs);

            $this->infoMsg(url('admin/setting'), "更新配置完成。");
            exit;
        }
        $setting = $this->_system->getAll();
        $setting['thumb'] = array_filter(explode(',', $setting['thumb']));

        return View('admin.setting.index', compact('setting'));
    }


}
