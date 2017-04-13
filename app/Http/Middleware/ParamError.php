<?php namespace App\Http\Middleware;

use Closure;

/**
 * 参数错误或无页面 中间件
 *
 */
class ParamError
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return response()->view('admin.error', array(), 404);
//        return $next($request);
    }
}
