<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 22:45
 */

namespace App\Repositories;

use App\Models\Navigation;

class NavigationRepository extends CommonRepository
{
    public function __construct(
        Navigation $object
    )
    {
        $this->model = $object;
    }

    public function getNavList()
    {
        return $this->model->where('status', 1)->get();
    }

    /**
     * 排序
     * @param $list
     */
    public function setSort($list){
        foreach ($list as $key => $value) {
            $this->model->where('id', $key)->update(['sort'=>$value]);
        }
    }

}