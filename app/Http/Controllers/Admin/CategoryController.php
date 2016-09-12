<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Config;
use Illuminate\Http\Request;
use Input;


/**
 * @property CategoryRepository model
 */
class CategoryController extends BaseController
{

    public $module = 'category';
    public $parent_module = 'content';

    /**
     * CategoryController constructor.
     * @param CategoryRepository $cate
     */
    public function __construct(
        CategoryRepository $cate
    )
    {
        parent::__construct();
        $this->model = $cate;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $data = $this->model->index();
//		$category = Category::get();
        return View('admin.content.category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $catdata = $this->model->getAll();
        return View('admin.content.category_create', compact('catdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->model->store($data);
        parent::infoMsg(url('admin/cate'), '添加分类完成');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
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
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->edit($id);
        $catdata = $this->model->getAll();
        return View('admin.content.category_edit', compact('data', 'catdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model->update($id, $data);
        parent::infoMsg(url('admin/cate'), '更新分类完成');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
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
