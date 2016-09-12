<?php namespace App\Http\Middleware;

use Closure;

/**
 * 权限不足抛出异常响应 中间件
 *
 */
class PermissionDenied
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
        return response()->view('admin.deny', array(), 403);
        return $next($request);
    }
}
