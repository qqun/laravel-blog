<?php
define('THEMES_NAME', 'themes');

/**
 * 前台View
 * @param null $view
 * @param array $data
 * @param array $mergeData
 * @return \Illuminate\Foundation\Application|mixed
 */
function siteView($view = null, $data = array(), $mergeData = array())
{
    $factory = app('Illuminate\Contracts\View\Factory');
    if (func_num_args() === 0) {
        dd($factory);
        return $factory;
    }
    $system = app('App\Repositories\SystemRepository')->getSystemCache();
    $theme = THEMES_NAME . '.' . $system['themes'];

    return $factory->make($theme . '.' . $view, $data, $mergeData);
}

/**
 * 输出Json
 * @param int $status
 * @param string $msg
 * @param null $other
 */
function exitJson($status = 1, $msg = '', $other = null)
{

    header("Content-Type: application/json; charset=utf-8");

    if (is_array($status) || is_object($status)) {
        echo json_encode($status, JSON_UNESCAPED_UNICODE);
        exit();
    }

    $status = (int)$status;
    $json = array('status' => $status, 'msg' => $msg);
    if (!is_null($other)) {
        $other = (array)$other;
        $json = array_merge($json, $other);
    }
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
    exit();
}

function jsJson($o)
{
    $o = json_encode($o, JSON_UNESCAPED_UNICODE);
    return str_replace("\\", "\\\\", $o);
}

function xml2obj($str)
{
    $postObj = simplexml_load_string($str, 'SimpleXMLElement', LIBXML_NOCDATA);
    return $postObj;
}


function uid($id = null)
{
    static $uid = null;

    if ($id) {
        $uid = abs((int)$id);
    } else {
        if ($uid === null) {
            $user = \Auth::user();
            $uid = $user ? (int)$user->id : 0;
        }
    }
    return $uid;
}


function http($url, $post = null, $header = array())
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    //curl_setopt($curl, CURLOPT_CAINFO, __DIR__.'/Keys/cacert.pem' );

    if ($post) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    if ($header) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    }

    $responseText = curl_exec($curl);
    curl_close($curl);
    return $responseText;
}


function csrf_check()
{
    if (Session::token() !== trim(Input::get('_token'))) {
        exitJson(1, 'You gave a valid CSRF token!');
    }
}

function check_email($email)
{
    return preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email);
}

function check_tel($tel)
{
    return preg_match("/^1[3458]\d{9}$/", $tel);
}

function pr($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function title_sub($title, $num = 40)
{
    return mb_substr($title, 0, $num, 'utf-8');
}

function _log($content = '')
{

    $post = e(file_get_contents('php://input'));
    if (!$post) $post = array_build($_POST, function ($k, $v) {
        return [$k, e($v)];
    });
    if (is_array($post) && $post) $post = json_encode($post, JSON_UNESCAPED_UNICODE);

    if (!$post) $post = '';

    if (is_string($content)) {
        $log_content = $content;
    } else {
        $log_content = $content->getMessage() . "\n" . $content->getTraceAsString();
    }

    DB::table('sys_logs')->insert([
        'user_id' => uid(),
        'url' => Request::method() . "  " . e(Request::fullUrl()),
        'post_content' => $post,
        'log_content' => $log_content,
        'remote_ip' => getIP(),
        'created_at' => date('Y-m-d H:i:s'),
    ]);

}


function getIP()
{
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
}


/**
 * 读取语言
 * @param $text
 * @return mixed
 */
function lang($text)
{
    return str_replace('app.', '', trans('app.' . $text));
}


function icon($data, $icon)
{
    return empty($data) ? $icon : $data;
}


/**
 * url 为服务的url地址
 * query 为请求串
 */
function sock_post($url, $query)
{
    $data = "";
    $info = parse_url($url);
    $fp = fsockopen($info["host"], 80, $errno, $errstr, 30);
    if (!$fp) {
        return $data;
    }
    $head = "POST " . $info['path'] . " HTTP/1.0\r\n";
    $head .= "Host: " . $info['host'] . "\r\n";
    $head .= "Referer: http://" . $info['host'] . $info['path'] . "\r\n";
    $head .= "Content-type: application/x-www-form-urlencoded\r\n";
    $head .= "Content-Length: " . strlen(trim($query)) . "\r\n";
    $head .= "\r\n";
    $head .= trim($query);
    $write = fputs($fp, $head);
    $header = "";
    while ($str = trim(fgets($fp, 4096))) {
        $header .= $str;
    }
    while (!feof($fp)) {
        $data .= fgets($fp, 4096);
    }
    return $data;
}


/**
 * 检查 特定数组 特定键名的键值 是否与待比较的值一致
 * 此helper主要用于角色权限特征判断
 *
 * @param array $array 传入的数组
 * @param string $key 待比较的数组键名
 * @param string $value 待比较的值
 * @return boolean 一致则返回true，否则返回false
 */
function check_array($array, $key, $value)
{
    $status = false;

    foreach ($array as $arr) {
        if ($arr[$key] === $value) {
            $status = true;
            break;
        } else {
            continue;
        }
    }

    return $status;
}


/**
 * 返回经stripslashes处理过的字符串或数组
 */
function new_stripslashes($string)
{
    if (!is_array($string)) return stripslashes($string);
    foreach ($string as $key => $val) $string[$key] = new_stripslashes($val);
    return $string;
}


/**
 * 将字符串转换为数组
 */
function string2array($data)
{
    if ($data == '') return array();
    return unserialize($data);
}

/**
 * 将数组转换为字符串
 */
function array2string($data, $isformdata = 1)
{
    if ($data == '') return '';
    if ($isformdata) $data = new_stripslashes($data);
    return serialize($data);
}


/**
 * 获取登录用户信息，用于登录之后页面显示或验证
 *
 * @param string $ret 限定返回的字段
 * @return string|object 返回登录用户相关字段信息或其ORM对象
 */
function user($ret = 'nickname')
{
    if (Auth::check()) {
        switch ($ret) {
            case 'nickname':
                return Auth::user()->nickname;  //返回昵称
                break;
            case 'username':
                return Auth::user()->username;  //返回登录名
                break;
            case 'email':
                return Auth::user()->email;  //返回Email
                break;
            case 'id':
                return Auth::user()->id;  //返回用户id
                break;
            case 'user_type':
                return Auth::user()->user_type;  //返回用户类型
                break;
            case 'object':
                return Auth::user();  //返回User对象
                break;
            default:
                return Auth::user()->nickname;  //默认返回昵称
                break;
        }
    } else {
        if ($ret === 'object') {
            $user = app()->make('App\Repositories\UserRepository');
            return $user->manager(1);
        } else {
            return 'No Auth::check()';
        }
    }
}



function getStatus($status, $id = 0, $type = 'status')
{
    // return intval($status) == 1 ? '启用' : '禁用';
    return intval($status) == 1 ?
        '<i class="fa fa-check text-success status" data-id="' . $id . '" data-status="0" data-type="' . $type . '"></i>' :
        '<i class="fa fa-ban text-danger status" data-id="' . $id . '" data-status="1" data-type="' . $type . '"></i>';
}

