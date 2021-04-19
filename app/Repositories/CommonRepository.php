<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/12
 * Time: 18:05
 */

namespace App\Repositories;


use \Config;

class CommonRepository extends BaseRepository
{


    public function getAll($data = [])
    {
        $model = $this->model;
        if(count($data) > 0){
            $model = $model->where($data);
        }
        return $model->orderBy('id', 'desc')->get();
    }


    public function saveDat($model, $inputs, $id = 0)
    {
        unset($inputs['_token']);

        if ($id == 0) {
            $inputs['created_at'] = date('Y-m-d H:i:s');
            $result = $model->insert($inputs);
        } else {
            unset($inputs['_method']);
            //TODO::checkbox
//            $inputs['status'] = isset($inputs['status']) ? 1 : 0;
            $result = $model->where('id', $id)->update($inputs);
        }
        return $result;
    }


    public function edit($id, $extra = [])
    {
        $data = $this->getById($id);
        return $data;
    }

    /**
     * @param array $fields
     * @param array $data
     * @param array $extra
     * @param int $size
     * @return mixed
     * @internal param array $fileds
     */
    public function index($data = [], $extra = [], $size = 10)
    {
        if ($size == 10) {
            $size = Config::get('site.page_count');
        }
        $m = $this->model;
//        $m = $this->model->where($data);

//        if (is_array($fields) && count($fields) > 1) {
//
//            if (isset($fields['value'])) {
//                $m = $m->select($fields['value']);
//            }
//            if (isset($fields['sql'])) {
//                echo $fields['sql'];
//
//                $m = $m->query($fields['sql']);
//            }
//
//        } else {
//            $m = $m->select($fields);

        if (is_array($data) && !empty($data)) {
            // join
            if (isset($data['join']) && !empty($data['join'])) {
                foreach ($data['join'] as $jk => $jv) {
                    $jOpt = explode('=', $jv);
                    if (count($jOpt) >= 2) {
                        $m = $m->join($jk, trim($jOpt[0], ' '), '=', trim($jOpt[1], ' '));
                    }
                }
            }
            // todo:leftJoin

            // condition
            if (isset($data['condition']) && !empty($data['condition'])) {
                $queryStr = 'where';

                foreach ($data['condition'] as $k => $v) {
                    if (!is_array($v[0])) $queryStr = $v[0];
                    $tmp = $v;

                    $m = $m->$queryStr(function ($query) use ($tmp) {
                        $queryStr = $tmp[0];
                        $w = explode(' ', $tmp[1]);
                        $query->$queryStr(trim($w[0], ' '), trim($w[1], ' '), trim($w[2], ' '));
//                    foreach ($tmp as $key => $value) {
//                        $queryStr = $value[0];
//                        $w = explode(' ', $value[1]);
//                        $query->$queryStr(trim($w[0], ' '), trim($w[1], ' '), trim($w[2], ' '));
//                    }
                    });

                }
            }

        }

        // 扩展参数

        if (is_array($extra) && count($extra) > 0) {
            if (isset($extra['order'])) {
                foreach ($extra['order'] as $k => $v) {
                    $m = $m->orderBy($v[0], $v[1]);
                }
            }

            if (isset($extra['group'])) {
                $m = $m->groupBy($extra['group']);
            }

        } else {
            $m = $m->orderBy('id', 'desc');
        }

        //
//        }


        if ($size == 0) {
            return $m->get();
        }
        return $m->paginate($size);
    }

    public function update($id, $inputs, $extra = [])
    {
        $data = $this->saveDat($this->model, $inputs, $id);
        return $data;
    }

    public function store($data = [], $extra = '')
    {
        $data = $this->saveDat($this->model, $data);
        return $data;
    }

    public function destroy($id = 0, $extra = '')
    {
        $data = $this->getById($id);
        $result = $data->delete();
        return $result;
    }

    public function updateStatus($type, $id, $status)
    {
        if (!isset($type) || !isset($id) || !isset($status))
            return false;
        if (in_array($type, ['status', 'type']) && in_array($status, [0, 1])) {
            return $this->model->where('id', $id)->update(["$type" => $status]);
        }
        return false;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getCount(){
            return $this->model->count();
    }
}