![build=passing](https://img.shields.io/badge/build-passing-brightgreen.svg?maxAge=2592000)
[![TeamCity CodeBetter](https://img.shields.io/teamcity/codebetter/bt428.svg?maxAge=2592000)](https://github.com/QQun/laravelBlog)
[![Latest Unstable Version](https://poser.pugx.org/laravel/laravel/v/unstable)](https://github.com/QQun/laravelBlog)
![php>=5.4](https://img.shields.io/badge/php->%3D5.4-orange.svg?maxAge=2592000)
[![License](https://poser.pugx.org/laravel/laravel/license)](https://github.com/QQun/laravelBlog)


> 系统需求
>
> PHP >= 5.5.9 - OpenSSL PHP 扩展 - PDO PHP 扩展 - Mbstring PHP 扩展 - Tokenizer PHP 扩展


### 更新说明
---
初始版本，包含文章分类、tag、等blog最基本元素。

已经可以正式上线使用， 后续会加入日历等功能。




### 截图
---
![image](https://raw.githubusercontent.com/QQun/assets/master/laravel/blog/index.png)
![image](https://raw.githubusercontent.com/QQun/assets/master/laravel/blog/post.png)
![image](https://raw.githubusercontent.com/QQun/assets/master/laravel/blog/admin.png)


### 安装
---
1.获取源代码


```Bash
git clone git@github.com:QQun/laravelBlog.git
cd laravelBlog
composer install
```
2.编辑 .env  配置文件

类似于

```
APP_ENV=local
APP_DEBUG=true
APP_KEY=YNmzhLQzH2fwe3o4RgzSEwqGg7gzfA8h

DB_HOST=localhost
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```
更改DB\_HOST为数据库地址、DB\_DATABASE为已经创建好的数据库的名称、DB\_USERNAME为数据库用户名、DB\_PASSWORD为数据库密码。

线上部署请确认 APP\_DEBUG 为false

3.执行部署导入数据库

```Bash
php artisan migrate
```
4.设置文件夹可写权限

设置缓存文件以及上传图片的位置为可写权限

```Bash
chmod -R 777 storage
chmod -R 777 public/assets
chmod -R 777 public/uploads
```

###文档
---
`Laravel原文文档` [https://laravel.com/docs/5.1](https://laravel.com/docs/5.1)

`Laravel中文文档` [http://www.golaravel.com/laravel/docs/5.1/](http://www.golaravel.com/laravel/docs/5.1/)


###使用模块
---
`laravelcollective/html` Forms & HTML 组件 -> [传送门](https://github.com/LaravelCollective/html)

`zizaco/entrust` Laravel用户权限解决方案 -> [传送门](https://github.com/Zizaco/entrust)

`suin/php-rss-writer` RSS -> [传送门](https://github.com/suin/php-rss-writer)

`nesbot/carbon` 时间处理 -> [传送门](https://github.com/briannesbitt/Carbon)


###演示
---
演示地址：[http://blog.jdcss.com](http://blog.jdcss.com/)


###其他
---
如有疑问 可在Github提出 [issue](https://github.com/QQun/laravelBlog/issues/new)



