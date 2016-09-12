<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\TagsRequest;
use App\Repositories\TagsRepository;
use Illuminate\Http\Request;

/**
 * @property TagsRepository model
 */
class TagsController extends BaseController
{

    public $module = 'tags';
    public $parent_module = 'content';

    /**
     * TagsController constructor.
     * @param TagsRepository $tags
     */
    public function __construct(
        TagsRepository $tags
    )
    {
        parent::__construct();
        $this->model = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->index();
        return View('admin.content.tags', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.content.tags_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagsRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        $data = $request->all();
        $this->model->store($data);
        parent::infoMsg(url('admin/tags'), '添加标签完成');
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
        return View('admin.content.tags_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagsRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsRequest $request, $id)
    {
        $data = $request->all();
        $this->model->update($id, $data);
        parent::infoMsg(url('admin/tags'), '编辑标签完成');
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
