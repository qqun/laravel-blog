<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 15:59
 */

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository extends CommonRepository
{

    public function __construct(Menu $object)
    {
        $this->model = $object;
    }

}