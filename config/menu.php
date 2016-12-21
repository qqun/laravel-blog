<?php
/**
 * Created by PhpStorm.
 * User: qq
 * Date: 16/8/25
 * Time: 14:44
 */


return [
    'admin' => [
        1 => ['title' => '控制面板', 'tag' => 'dashboard', 'href' => '#', 'icon' => '', 'children' => [
            2 => ['title' => '概述', 'tag' => 'console', 'href' => '/admin', 'icon' => ''],
            3 => ['title' => '清除缓存', 'tag' => 'cache', 'href' => '/admin/clear', 'icon' => ''],
            4 => ['title' => '系统设置', 'tag' => 'system', 'href' => '/admin/setting', 'icon' => ''],
            5 => ['title' => '导航设置', 'tag' => 'nav', 'href' => '/admin/nav', 'icon' => ''],
            6 => ['title' => '友链设置', 'tag' => 'links', 'href' => '/admin/links', 'icon' => ''],
        ]],
        2 => ['title' => '内容管理', 'tag' => 'content', 'href' => '#', 'icon' => 'fa-file', 'children' => [
            2 => ['title' => '分类管理', 'tag' => 'category', 'href' => '/admin/cate', 'icon' => ''],
            3 => ['title' => '文章管理', 'tag' => 'article', 'href' => '/admin/article', 'icon' => ''],
            4 => ['title' => '标签管理', 'tag' => 'tags', 'href' => '/admin/tags', 'icon' => ''],
        ]],
        3 => ['title' => '用户管理', 'tag' => 'users', 'href' => '#', 'icon' => 'fa-user', 'children' => [
            2 => ['title' => 'Users', 'tag' => 'users', 'href' => '/admin/users', 'icon' => ''],
            3 => ['title' => 'Roles', 'tag' => 'roles', 'href' => '/admin/roles', 'icon' => ''],
            4 => ['title' => 'Permissions', 'tag' => 'permissions', 'href' => '/admin/permissions', 'icon' => ''],
        ]],


    ],

];