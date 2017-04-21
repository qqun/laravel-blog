<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Http\Requests;
use Cache;
use View;

class BaseController extends Controller
{
    /**
     * header 信息
     * @var
     */
    protected $head;
    /**
     * 系统设置信息
     * @var
     */
    protected $setting;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $system = app('App\Repositories\SystemRepository');

        $this->setting = $system->getSystemCache();

        if (!$this->setting['status']) {
            die($this->setting['note']);
        }

        $nav = app('App\Repositories\NavigationRepository');
        $article = app('App\Repositories\ArticleRepository');
        $cate = app('App\Repositories\CategoryRepository');
        $tags = app('App\Repositories\TagsRepository');
        $links = app('App\Repositories\LinksRepository');
        $users = app('App\Repositories\UserRepository');


        $nav = $nav->getNavList();
        $artHot = $article->getHot();
        $artNew = $article->getNew();
//        $category = $cate->getAll(['status' => 1]);
        /*
        $fields = [
            'categories.id as id',
            'categories.pid as pid',
            'categories.title as title',
            'categories.keywords as keywords',
            'categories.description as description',
            'categories.thumb as thumb'
        ];
        $param = [
            'join' => [
                'articles' => 'articles.cat_id = categories.id'
            ],
            'condition' => [
                ['where', "categories.status = 1"]
            ],
        ];
        $extra = [
            'order' => [
                ['categories.sort', 'desc'],
                ['categories.id', 'desc']
            ],
            'group' => 'categories.id',
        ];
        $category = $cate->index($fields, $param, $extra, 0);
        */

        $category = $cate->getAll(['categories.status'=>1]);


        $tags = $tags->getHot([], 10);
        $links = $links->getAll(['status' => 1]);

        $user = $users->getUserInfoById(1);

        $this->head['title'] = $this->setting['title'];
        $this->head['keyword'] = $this->setting['keywords'];
        $this->head['description'] = $this->setting['description'];
        $this->head['site-description'] = $this->setting['site-description'];

        $thumb = explode(',', $this->setting['thumb']);
        $thumb = array_filter($thumb);
        if (count($thumb) == 0) {
            $thumb = ['/assets/blog/bg/single-2.jpg'];
        }

        View::share('nav', $nav);
        View::share('tags', $tags);
        View::share('artNew', $artNew);
        View::share('artHot', $artHot);
        View::share('category', $category);
        View::share('links', $links);
        View::share('head', $this->head);
        View::share('user', $user);
        View::share('thumb', $thumb);

    }

}
