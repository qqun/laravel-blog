<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\NavigationRequest;
use App\Repositories\NavigationRepository;
use Illuminate\Http\Request;
use Input;
use View;

/**
 * @property NavigationRepository model
 */
class NavigationController extends BaseController
{

    public $module = 'nav';
    public $parent_module = 'dashboard';

    public function __construct(
        NavigationRepository $nav
    )
    {
        parent::__construct();
        $this->model = $nav;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->index();
        return View('admin.setting.nav', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.setting.nav_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NavigationRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavigationRequest $request)
    {
        $data = $request->all();
        $this->model->store($data);
        parent::infoMsg(url('admin/nav'), '添加导航完成');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = e(Input::get('type'));
        $status = (int)Input::get('status');
        switch ($type) {
            case 'status':
                $this->model->updateStatus($type, $id, $status);
                break;
            default:
                exitJson(99, 'Done');
                break;
        }
        exitJson(0, 'Done!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->edit($id);
        return View('admin.setting.nav_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NavigationRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavigationRequest $request, $id)
    {
        $data = $request->all();
        $this->model->update($id, $data);
        parent::infoMsg(url('admin/nav'), '更新导航完成');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->destroy($id);
        if ($result) {
            exitJson(0, 'done');
        } else {
            exitJson(99, 'done!');
        }
    }
}
