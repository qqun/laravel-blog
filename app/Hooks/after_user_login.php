<?php

//\Hook::apply('after_user_login', [$u]);
// 用户登录后触发，保存日志
return [

	function($user){
		if($user->id == 1){
			_log($user->email.'登录后台系统：'.date('Y-m-d H:i:s', time()));
			// if($user->phone){
			// 	\App\Lib\Yunpian::send($user->phone, 000,['time'=>date('m月d日H:i:s', time())]);
			// }
		}
	},
];