<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use App\Repositories\TagsRepository;

class SearchController extends BaseController
{
    private $_article, $_tag;

    public function __construct(
        ArticleRepository $article,
        TagsRepository $tag
    )
    {
        parent::__construct();
        $this->_article = $article;
        $this->_tag = $tag;
    }

    public function getKeyword($key = '')
    {
        if (empty($key)) {
            return redirect()->action('Home\IndexController@index');
        }
        $data = $this->_article
            ->getArticleListByKeyword($key);

        return siteView('search', compact('data', 'key'));

    }

    public function getTag($tag = '')
    {
        if (empty($tag)) {
            return redirect()->action('Home\IndexController@index');
        }
        $data = $this->_article->getArticleListByTags($tag);
        return siteView('searchTag', compact('data', 'tag'));
    }

}
