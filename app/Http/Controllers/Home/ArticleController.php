<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use Input;

class ArticleController extends BaseController
{
    private $_article;

    public function __construct(
        ArticleRepository $article
    )
    {
        parent::__construct();
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
            exitJson(9,'没有这篇文章');
        }
        $type = trim(Input::get('type') );
        if($type == 'like'){
            $this->_article->setLike($id);
            exitJson(0,'Done');
        }

        $article = $this->_article->edit($id);
        $this->_article->setHits($id);

        $next = $this->_article->getArticleByNext($id);
        return siteView('article', compact('article', 'next'));
    }

}
