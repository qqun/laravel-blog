<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagsRepository;
use Illuminate\Http\Request;
use Input;
use View;

/**
 * @property ArticleRepository model
 */
class ArticleController extends BaseController
{

    public $module = 'article';
    public $parent_module = 'content';

    private $cate;
    private $tags;


    /**
     * @param ArticleRepository $article
     * @param CategoryRepository $cate
     * @param TagsRepository $tags
     */
    public function __construct(
        ArticleRepository $article,
        CategoryRepository $cate,
        TagsRepository $tags
    )
    {
        parent::__construct();
        $this->model = $article;
        $this->cate = $cate;
        $this->tags = $tags;

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->all();
        $param = [];
        $title = $request->get('title');
        if (isset($title ) ) {
            $param = [
                ['where',"title like %$title%"],
            ];
        }
        $data = $this->model->index($param, [['id', 'desc']]);

        $catData = $this->cate->getAll();

        $catData = array_build($catData, function ($k, $v) {
            return [$v->id, $v->title];
        });

        return View('admin.content.article', compact('data', 'catData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $catData = $this->cate->getAll();
        $tags = $this->tags->getLists();

        return View('admin.content.article_create', compact('catData', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->all();
        $result = $this->model->store($data);

        parent::infoMsg(url('admin/article'), '添加文章完成');
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
            case 'type':
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
        $catData = $this->cate->getAll();
        $tagsData = $this->tags->getAll();

        $tags = array_build($data->getTags, function ($k, $v) {
            return [$k, $v->id];
        });
        return View('admin.content.article_edit', compact('data', 'catData', 'tagsData', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $data = $request->all();
        $this->model->update($id, $data);

        parent::infoMsg(url('admin/article'), '更新文章完成');
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
