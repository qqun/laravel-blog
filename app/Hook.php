<?php


/*


\Hook::apply('after_*',[$x]);
\Hook::apply('before_*',[$x]);
*/

class Hook
{

    private static $path = null;
    private static $actions = [];

    public static function apply($hook, array $p = [])
    {

        if (static::$path === null) static::$path = __DIR__ . '/Hooks/';

        $hook = (string)$hook;

        //钩子已执行
        if (isset(static::$actions[$hook])) return;

        static::$actions[$hook] = true;

        //钩子不存在
        $hook = static::$path . $hook . '.php';

        if (!file_exists($hook)) return;

        $hooks = require $hook;

        if (is_array($hooks)) {
            foreach ($hooks as $key => $value) {
                if (is_callable($value)) call_user_func_array($value, $p);
            }
        } else {
            if (is_callable($hooks)) call_user_func_array($hooks, $p);
        }
    }

}