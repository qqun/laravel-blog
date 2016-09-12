<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 18:36
 */

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    public function __construct(Category $object)
    {
        $this->model = $object;
    }

    public function getCateInfoByid($id)
    {
        return $this->model
            ->where('status', 1)
            ->where('id', $id)

            ->first();
    }

    public function getCount($data = []){
        return $this->model
            ->where($data)
            ->count();
    }


}