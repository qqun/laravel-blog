<?php

namespace App\Presenters;


class HomePresenter
{


    /**
     * 文章缩略图
     * @param $model
     * @return string
     */
    public function showThumb($model)
    {
        if (!empty($model->thumb)) {
            return '<div class="widget-img"><a href="' . url('article/' . $model->id) . '">' .
            '<img src="' . $model->thumb . '" alt="image"><div class="widget-overlay"></div>' .
            '<i class="fa fa-search" aria-hidden="true"></i></a></div>';
        } else {
            return '';
        }
    }


    /**
     * 分类图片
     * @param $cate
     * @return string
     */
    public function cateThumb($cate)
    {
        if (!empty($cate->thumb))
            return '<img src="' . $cate->thumb . '" alt="img" class="img-responsive">';

    }


    /**
     * 首页文章图
     * @param $article
     * @return string
     */
    public function indexThumb($article)
    {
        if (!empty($article->thumb)) {
            return '<div class="post-thumb ps-rel"><a href="' . url('article/' . $article->id) . '">' .
            '<img src="' . $article->thumb . '" alt="img" class="img-responsive"></a></div>';
        }
        return '<div style="padding:15px;"></div>';
    }

    /**
     * 获取并显示某文章tags
     * @param $article
     * @return string
     */
    public function showTags($article)
    {
        if (!empty($article->getTags)) {
            $str = '<span class="post-tags"><i class="fa fa-fw fa-tag" aria-hidden="true"></i>';
            foreach ($article->getTags as $tag) {
                $str .= '<a href="' . url('search/tag', ['tag' => urlencode($tag->name)]) .
                    '"><div class="label label-tag">' . $tag->name . '</div></a>';
            }
            $str .= '</span>';
            return $str;
        }

    }


}