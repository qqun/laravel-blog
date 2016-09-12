<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;


class UserLogout extends Event
{
	use SerializesModels;



	public function __construct($user)
	{
		//处理登出事件
		_log($user->email.'('.$user->name.')登出后台系统');
		$this->user = $user;
	}
}