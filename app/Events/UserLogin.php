<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;


class UserLogin extends Event
{
	use SerializesModels;

	//	event(new UserLogin(user('object')));
	public function __construct($user)
	{
		//处理登录事件
		_log($user->email.'('.$user->name.')登录后台系统');
		$this->user = $user;
	}
}