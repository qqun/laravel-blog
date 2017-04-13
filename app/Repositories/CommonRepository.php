<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/12
 * Time: 18:05
 */

namespace App\Repositories;


use Config;

class CommonRepository extends BaseRepository
{


    public function getAll($data = [])
    {
        return $this->model->where($data)->orderBy('id', 'desc')->get();
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
     * @param array $data
     * @param array $extra
     * @param int $size
     * @return mixed
     */
    public function index($data = [], $extra = [], $size = 10)
    {
        if ($size == 10) {
            $size = Config::get('site.page_count');
        }
        $m = $this->model;
//        $m = $this->model->where($data);

        if (is_array($data) && !empty($data)) {
            $queryStr = 'where';
            foreach ($data as $k => $v) {
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
        if (is_array($extra) && count($extra) > 0) {
            foreach ($extra as $k => $v) {
                $m = $m->orderBy($v[0], $v[1]);
            }
        } else {
            $m = $m->orderBy('id', 'desc');
        }
        return $m->paginate($size);
    }

    public function update($id, $inputs, $extra = [])
    {
        $data = $this->saveDat($this->model, $inputs, $id);
        return $data;
    }

    public function store($data, $extra = [])
    {
        $data = $this->saveDat($this->model, $data);
        return $data;
    }

    public function destroy($id, $extra = '')
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
}