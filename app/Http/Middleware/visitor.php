<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\http\RedirectResponse;


/**
 * 游客认证中间件
 */
class Visitor{

	protected $auth;

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		if($this->auth->check())
		{
			return new RedirectResponse(route('admin'));
		}

		return $next($request);
	}
}

