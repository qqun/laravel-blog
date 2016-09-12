<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 23:08
 */

namespace App\Repositories;

use App\Models\Links;

class LinksRepository extends CommonRepository
{
    public function __construct(
        Links $object
    )
    {
        $this->model = $object;
    }

    public function getAll($data = [])
    {
        return $this->model->where($data)->get();
    }

}