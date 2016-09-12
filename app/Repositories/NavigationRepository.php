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

}