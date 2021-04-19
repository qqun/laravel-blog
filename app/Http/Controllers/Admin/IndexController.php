<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagsRepository;
use DB;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    private $_category,$_article,$_tags;

    /**
     * IndexController constructor.
     * @param CategoryRepository $cat
     * @param ArticleRepository $art
     */
    public function __construct(
        CategoryRepository $cat,
        ArticleRepository $art,
        TagsRepository $tag
    )
    {
        parent::__construct();
        $this->_category = $cat;
        $this->_article = $art;
        $this->_tags = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //登录后页面
        $version = DB::select('select version() as version');
        $info = DB::select('select CREATE_TIME from information_schema.tables where table_schema="'
            . DB::getDatabaseName()
            . '" order by CREATE_TIME asc limit 1');

        $data = array(
            'os' => PHP_OS,
            'ip' => $_SERVER['SERVER_ADDR'],
            'web_server' => $_SERVER['SERVER_SOFTWARE'],
            'php_ver' => PHP_VERSION,
            'mysql_ver' => DB::getDriverName() . ' v' . $version[0]->version,
            'zlib' => function_exists('gzclose') ? 'yes' : 'no',
            'safe_mode' => ini_get('sofe_mode') ? 'yes' : 'no',
            'safe_mode_gid' => ini_get('safe_mode_gid') ? 'yes' : 'no',
            'timezone' => function_exists('date_default_timezone_get') ? date_default_timezone_get() : 'no_timezone',
            'socket' => function_exists('fsockopen') ? 'yes' : 'no',
            'gd' => extension_loaded('gd') ? 'yes' : 'no',
            'file' => ini_get('upload_max_filesize'),
            'time' => $info[0]->CREATE_TIME,

            'catCount' => $this->_category->getCount(),
            'artCount' => $this->_article->getCount(),
            'tagCount' => $this->_tags->getCount(),
            'thumb' => 1,
            'up' => 2,
        );


        return View('admin.console', compact('data'));
    }


}
