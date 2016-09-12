<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\LinksRequest;
use App\Repositories\LinksRepository;
use Illuminate\Http\Request;
use Input;
use View;

/**
 * @property LinksRepository model
 */
class LinksController extends BaseController
{

    public $module = 'links';
    public $parent_module = 'dashboard';

    /**
     * LinksController constructor.
     * @param LinksRepository $links
     */
    public function __construct(
        LinksRepository $links
    )
    {
        parent::__construct();
        $this->model = $links;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->index();
        return View('admin.setting.links', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.setting.links_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinksRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksRequest $request)
    {
        $data = $request->all();
        $this->model->store($data);
        parent::infoMsg(url('admin/links'), '添加链接完成');
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
        return View('admin.setting.links_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinksRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinksRequest $request, $id)
    {
        $data = $request->all();
        $this->model->update($id, $data);
        parent::infoMsg(url('admin/links'), '更新链接完成');
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
