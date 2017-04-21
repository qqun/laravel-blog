<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Input;

class ArticleController extends BaseController
{
    private $_article;
    private $_cat;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $article
     * @param CategoryRepository $cat
     */
    public function __construct(
        ArticleRepository $article,
        CategoryRepository $cat
    )
    {
        parent::__construct();
        $this->_article = $article;
        $this->_cat = $cat;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        if ($id == 0) {
            exitJson(9, '没有这篇文章');
        }
        $type = trim(Input::get('type'));
        if ($type == 'like') {
            $this->_article->setLike($id);
            exitJson(0, 'Done');
        }

        $article = $this->_article->edit($id);
        $this->_article->setHits($id);

        $next = $this->_article->getArticleByNext($id);
        $cat = $this->_cat->getById($article->cat_id);
        return siteView('article', compact('article', 'next', 'cat'));
    }

}
