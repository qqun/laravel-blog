<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use App\Services\RssFeed;
use App\Services\SiteMap;

class IndexController extends BaseController
{
    private $_article;

    public function __construct(ArticleRepository $article)
    {
        parent::__construct();
        $this->_article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $topData = $this->_article->index(['status'=>1,'type'=>1],[],3);
        $param = [
            ['where','status = 1'],
        ];
        $data = $this->_article->index($param, [['type','desc'],['id','desc']], 6);
        // 新文章列表 数量8
        $topData = [];
        // 热门文章 数量3
        // 可用导航

        // 可用友情链接
        // 热门Tags 数量13

        return siteView('index', compact('data','topData'));
    }


    public function rss(RssFeed $feed)
    {
        $rss = $feed->getRss();
        return response($rss, 200, ['Content-type' => 'application/rss+xml']);
    }

    public function map(SiteMap $siteMap)
    {
        $map = $siteMap->getSiteMap();
        return response($map, 200, ['Content-type' => 'text.xml']);
    }

}
