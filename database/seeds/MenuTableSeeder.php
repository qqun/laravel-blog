<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 15/7/21
 * Time: 14:20
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{

    /**
     *
     */
    public function run()
    {
        return;
        DB::table('menus')->delete();
        $date = date('Y-m-d H:i:s');
        $data = [
            [
                'title' => '控制面板',
                'pid' => 0,
                'sort' => 0,
                'url' => '#',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => '概述',
                'pid' => 1,
                'sort' => 0,
                'url' => '/admin',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => '清除缓存',
                'pid' => 1,
                'sort' => 0,
                'url' => '/admin/clear',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => '系统设置',
                'pid' => 1,
                'sort' => 0,
                'url' => '/admin/setting',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => 'User',
                'pid' => 0,
                'sort' => 0,
                'url' => '#',
                'icon' => 'fa-user',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => 'All User',
                'pid' => 5,
                'sort' => 0,
                'url' => '/admin/users',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => 'Roles',
                'pid' => 5,
                'sort' => 0,
                'url' => '/admin/roles',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'title' => 'Permissions',
                'pid' => 5,
                'sort' => 0,
                'url' => '/admin/permissions',
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ];
        DB::table('menus')->insert($data);
    }
}

