<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Http\Requests;
use View;

class BaseController extends Controller
{
    public $head;

    public function __construct()
    {
        $system = app('App\Repositories\SystemRepository');

        if (!$system->getStatus()) {
            die('系统维护,请稍后访问');
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
        $category = $cate->getAll(['status' => 1]);

        $tags = $tags->getHot([], 10);
        $links = $links->getAll(['status' => 1]);

        $user = $users->getUserInfoById(1);
        $system = $system->getAll();

        $this->head['title'] = $system['title'];
        $this->head['keyword'] = $system['keywords'];
        $this->head['description'] = $system['description'];

        View::share('nav', $nav);
        View::share('tags', $tags);
        View::share('artNew', $artNew);
        View::share('artHot', $artHot);
        View::share('category', $category);
        View::share('links', $links);
        View::share('head', $this->head);
        View::share('user', $user);
    }

}
