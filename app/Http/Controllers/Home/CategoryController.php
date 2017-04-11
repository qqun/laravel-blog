<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;

class CategoryController extends BaseController
{
    private $_cate;
    private $_article;

    public function __construct(
        CategoryRepository $cate,
        ArticleRepository $article
    )
    {
        parent::__construct();
        $this->_cate = $cate;
        $this->_article = $article;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        if($id == 0){
            exitJson(9,'没有这个分类');
        }
        $cate = $this->_cate->getCateInfoByid($id);
        $data = $this->_article->getArticleListByCatId($id, $this->setting['pagesize']);
        if (empty($data)) {
            exitJson(401,'Category Error!!');
        }
        if(empty($cate)){
            exitJson(402,'Category Error!!');
        }


        return siteView('category', compact('cate', 'data'));

    }


}
