<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		if($e instanceof NotFoundHttpException){
			exitJson(404,'404');
		}
		if(\Config::get('app.debug')){
			return parent::report($e);
		}
		$msg = "File:".$e->getFile().",Line:".$e->getLine().",Error:".$e->getMessage();

		if( isset( $_SERVER['REQUEST_URI'] ) ){
			exitJson(500,'服务器出错'.$msg);
		}
		else{
			echo "服务器出错\n",$msg,"\n";
			exit();
		}

	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		return parent::render($request, $e);
	}

}
