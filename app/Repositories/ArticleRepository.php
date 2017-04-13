<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 16:21
 */

namespace App\Repositories;


use App\Models\Article;
use App\models\Tags;
use DB;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository extends CommonRepository
{

    private $_tags;
    private $_sys;

    /**
     * @param Article $object
     * @param Tags|\App\Repositories\TagsRepository $tags
     * @param SystemRepository $sys
     * @internal param Article $article
     */
    public function __construct(
        Article $object,
        TagsRepository $tags,
        SystemRepository $sys
    )
    {
        $this->model = $object;
        $this->_tags = $tags;
        $this->sys = $sys->getSystemCache();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getCount($data = [])
    {
        return $this->model
            ->where($data)
            ->count();
    }

    /**
     * 更新文章
     * @param $inputs
     * @param int $id
     */
    public function saveData($inputs, $id = 0)
    {
        unset($inputs['_token']);
        if (isset($inputs['tags'])) {
            $ta = $inputs['tags'];
        } else {
            $ta = [];
        }

        if (isset($inputs['tags']) && is_array($inputs['tags'])) {
            $inputs['tags'] = implode(',', $inputs['tags']);
        }


        if ($id == 0) {
            unset($inputs['tags1']);

            $ta = self::syncTags($this->model, $ta);
            $inputs['created_at'] = date('Y-m-d H:i:s');
            $result = $this->model->insertGetId($inputs);
            $this->model->find($result)->getTags()->attach($ta);
        } else {
            //edit
            unset($inputs['_method']);

            $art = $this->model->find($id);
            $ta = self::syncTags($art, $ta, true);

            $this->model->where('id', $id)->update($inputs);
            $this->model->find($id)->getTags()->sync($ta);
        }

    }

    /**
     * 多对多,更新文章标签
     * @param $article
     * @param array $tags
     * @param bool $isNew
     * @return array
     */
    public function syncTags($article, $tags = [], $isNew = false)
    {
        //获取所有标签
        $tagsAll = $this->_tags->getAll();
        // 新添加标签//更新的标签//存在的标签
        $newTags = $upTags = $existsTags = [];
        if (!empty($tagsAll)) {
            foreach ($tagsAll as $tag) {
                $existsTags[] = $tag['name'];
            }
        }
        unset($tagsAll);


        //当前文章的tags
        if ($tags) {
            foreach ($tags as $tag) {
                $tag = trim($tag);
                $tag = preg_replace('/\s/', "", $tag);
                $tag = mb_strtolower($tag, 'UTF-8');
                //如果当前标签存在于系统内
                if (in_array($tag, $existsTags)) {
                    //数量增加
                    $tmpId = $this->_tags->incrementNumber($tag, $isNew);
                    $newTags[] = $tmpId;
                    $upTags[] = $tmpId;
                } else {
                    //标签不存在则创建
                    $upTags[] = $this->_tags->addTags($tag);
                }
            }
        }

        //如果是更新, 重新计算tags 引用数量
        if ($isNew) {
            $oldTags = $article->getTags;
            $oldTags = array_build($oldTags, function ($k, $v) {
                return [$k, $v->id];
            });
            $delTags = array_diff($oldTags, $upTags);
            $addTags = array_diff($upTags, $oldTags);
            //有取消的tag 重新计数
            if (!empty($delTags)) {
                $this->_tags->decrementNumber($delTags);
            }
            //有增加的tag 重新计数
            if (!empty($addTags)) {
                foreach ($addTags as $aTag) {
                    if (!in_array($addTags, $newTags)) {
//                        Tags::where('id', $aTag)->increment('number');
                    }
                }
            }

        }

        return $upTags;
    }

    /**
     * @param array $data
     * @param array $extra
     * @return array|void
     */
    public function store($data, $extra = [])
    {
        return self::saveData($data);

    }

    /**
     * @param int $id
     * @param array $inputs
     * @param array $extra
     * @return array|void
     */
    public function update($id, $inputs, $extra = [])
    {
        return self::saveData($inputs, $id);
    }

    public function destroy($id, $extra = '')
    {
        $data = $this->getById($id);
        $tags = array_build($data->getTags, function ($k, $v) {
            return [$k, $v->id];
        });
        // 更新Tags 统计数量
        $this->_tags->decrementNumber($tags);
        $result = $data->delete();
        return $result;
    }



    /**
     * 前台调用
     */

    /**
     * 获取热点文章
     * @param int $limit
     * @return mixed
     */
    public function getHot($limit = 5)
    {
        return $this->model
            ->where('status', 1)
            ->orderBy('hits', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * 获取最新文章
     * @param int $limit
     * @return mixed
     */
    public function getNew($limit = 5)
    {
        return $this->model
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * 浏览次数
     * @param $id
     * @return mixed
     */
    public function setHits($id)
    {
        return $this->model
            ->where('id', $id)
            ->increment('hits');
    }

    public function setLike($id)
    {
        return $this->model
            ->where('id', $id)
            ->increment('heart');
    }


    /**
     * 通过关键字获取文章列表
     * @param $key
     * @param int $size
     * @return mixed
     */
    public function getArticleListByKeyword($key, $size = 1)
    {
        if ($size == 1) $size = $this->_sys['pagesize'];
        return $this->model
            ->where('title', 'like', "%$key%")
            ->orderBy('id', 'desc')
            ->paginate($size);
    }

    /**
     * 通过Tag id获取文章
     * @param $id
     * @param int $size
     * @return mixed
     */
    public function getArticleListByTagsId($id, $size = 1)
    {
        if ($size == 1) $size = $this->_sys['pagesize'];
        $article = $this->_tags
            ->edit($id)
            ->getArticles;
        //TODO:: Page
        return $article->paginate($size);
    }

    /**
     * 通过tag 获取文章
     * @param $tag
     * @param int $size
     * @return mixed
     */
    public function getArticleListByTags($tag, $size = 1)
    {
        if ($size == 1) $size = $this->_sys['pagesize'];

        $id = $this->_tags->getTagIdByTag($tag);
        if (!$id) {
            return [];
        }
        return $article = $this->_tags
            ->edit($id)
            ->getArticles;
    }

    /**
     * 通过分类ID获取文章列表
     * @param $id
     * @param int $size
     * @return mixed
     */
    public function getArticleListByCatId($id, $size = 1)
    {
        if ($size == 1) $size = $this->_sys['pagesize'];
        return $this->model
            ->where('cat_id', $id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate($size);
    }

    /**
     * 上一篇,下一篇
     * @param $id
     * @return array
     */
    public function getArticleByNext($id)
    {
        $next = $this->model->where('id', '>', $id)->orderBy('id', 'asc')->limit(1)->select('id', 'title')->first();
        $previous = $this->model->where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->select('id', 'title')->first();
        return ['next' => $next, 'previous' => $previous];
    }

}
