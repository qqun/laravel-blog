<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 23:32
 */

namespace App\Repositories;

use App\Models\Tags;

class TagsRepository extends CommonRepository
{

    public function __construct(
        Tags $tags
    )
    {
        $this->model = $tags;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function getLists($data = [])
    {
        $model = $this->model;
        if(count($data) > 0){
            $model = $model->where($data);
        }

        return $model->lists('name', 'id');
    }

    


    /**
     * 获取一定数量的热门tag
     * @param array $data
     * @param int $limit
     * @return mixed
     */
    public function getHot($data = [1=>1], $limit = 10)
    {
        $model = $this->model
            ->where('number', '>', 0);
        if(count($data) > 0){
            $model = $model->where($data);
        }
        return $model->orderBy('number', 'desc')
            ->limit($limit)
            ->select('id', 'name', 'number')
            ->get();
    }

    /**
     * Tag 数量递减
     * @param $tags
     * @return mixed
     */
    public function decrementNumber($tags)
    {
        return $this->model->whereIn('id', $tags)->decrement('number');
    }

    /**
     * Tag 数量递增 :: 如果是更新则不递增
     * @param $tag
     * @param $isNew 更新状态
     * @return mixed 操作ID
     */
    public function incrementNumber($tag, $isNew)
    {
        $t = $this->model->where('name', $tag);
        if (!$isNew) {
            $t->increment('number');
        }
        return $tmpId = $t->pluck('id');
    }

    /**
     * 添加新的 Tag
     * @param $tag
     * @return mixed 操作ID
     */
    public function addTags($tag)
    {
        return $this->model->insertGetId(['name' => $tag, 'number' => 1]);
    }


    /**
     * 通过ID获取TagName
     * @param $id
     * @return mixed
     */
    public function getTagNameByTagId($id)
    {
        return $this->model
            ->where('id', $id)
            ->pluck('name');
    }

    /**
     * 通过tag 获取tagName
     * @param $tag
     * @return mixed
     */
    public function getTagIdByTag($tag)
    {
        $tag = trim($tag);
        $tag = preg_replace('/\s/', "", $tag);
        $tag = mb_strtolower($tag, 'UTF-8');
        return $this->model
            ->where('name', $tag)
            ->pluck('id');
    }


}