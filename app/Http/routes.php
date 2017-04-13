<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['prefix' => '/api/v1'], function () {
    Route::pattern('any', '.*');
    Route::pattern('id', '[0-9]+');

    Route::any('/', function () {
        exitJson(0, 'hello');
    });

    $controllers = [
        'log' => 'LogController',
    ];

    $controller = strtolower(Request::segment(3));
    if (isset($controllers[$controller])) {
        Route::resource($controller, $controllers[$controller]);
    }

    if ($controller == 'listen') {

    }
});


/**
 *
 * 前台展示
 */
Route::group(['prefix' => '/', 'namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/about/{id?}', 'AboutController@show');
    Route::get('/article/{id?}', 'ArticleController@show');
    Route::get('/category/{id?}', 'CategoryController@show');
    Route::get('/search/tag/{tag?}', 'SearchController@getTag');
    Route::get('/search/keyword/{key?}', 'SearchController@getKeyword');


    Route::get('/rss', 'IndexController@rss');
    Route::get('/sitemap.xml', 'IndexController@map');

});


// 后台登录


Route::group(['prefix' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/index', 'AuthController@getIndex');
    Route::get('/login', 'AuthController@getIndex');
    // Route::get(['/index','/login'], 'AuthController@getIndex');
    Route::post('/login', 'AuthController@postLogin');
    Route::get('/logout', 'AuthController@getLogout');
});


// 后台管理
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/', 'IndexController@index');

    //文件上传
    Route::get('/upload', 'UploadController@getUpload');
    Route::post('/upload', 'UploadController@postUpload');

    //清除缓存
    Route::get('/clear', 'BaseController@getRefreshCache');

    //个人资料
    Route::match(['get', 'post'], '/profile/{id?}', 'UsersController@profile');

    Route::match(['get', 'post'], '/setting', 'SettingController@index');

    Route::post('/nav/index', 'NavigationController@postIndex');

    $controllers = [
        //Article
        'article' => 'ArticleController',
        'cate' => 'CategoryController',
        'tags' => 'TagsController',
        'nav' => 'NavigationController',
        'links' => 'LinksController',

        'users' => 'UsersController',
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
    ];


    $controller = strtolower(Request::segment(2));
    if (isset($controllers[$controller])) {
        Route::resource($controller, $controllers[$controller]);
    }


});



