<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 18:36
 */

namespace App\Repositories;

use App\Models\System;
use Cache;

class SystemRepository extends CommonRepository
{
    public function __construct(System $object)
    {
        $this->model = $object;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getAll($data = [])
    {
        $setting = $this->model->get();
        $setting = array_build($setting, function ($k, $v) {
            return [$v->key, $v->value];
        });
        return $setting;
    }

    /**
     * @param int $id
     * @param array $inputs
     * @param array $extra
     * @internal param int $data
     */
    public function update($id, $inputs, $extra = [])
    {
        unset($inputs['_token']);
        foreach ($inputs as $key => $val) {
            $this->model
                ->where('key', trim($key))
                ->update(['value' => $val]);
        }
        Cache::forever('system', $inputs);
        return;
    }


    /**
     * 获取系统状态
     * @param string $key
     * @return mixed
     */
    public function getStatus($key = 'status')
    {
        return $this->model->where('key', trim($key))->pluck('value');
    }

    /**
     * 读取系统配置缓存
     * @return mixed
     */
    public function getSystemCache(){
        $result = [];
        if(Cache::has('system')) {
            $result = Cache::get('system');
        }else{
            $tmp = $this->model->get()->toArray();
            foreach($tmp as $key=>$value){
                $result[$value['key']] = $value['value'];
            }
            Cache::forever('system', $result);
        }
        return $result;
    }


}