<?php namespace App\Http\Controllers\Admin;

use App\Events\UserLogin as Userlogin;
use App\Events\UserLogout as UserLogout;
use App\Http\Requests;
use Auth;
use DB;
use Illuminate\Http\Request;
use Input;
use Redirect;

class AuthController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('visitor', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return View('admin.login');
    }

    /**
     * 登录验证
     */
    public function postLogin(Request $request)
    {
        //可调节为邮箱 or 用户名 双登录

        $user = [
            'password' => trim(Input::get('password')),
            // 'email' => trim(Input::get('account')),
            'status' => 1,
            'user_type' => 'Manager',
        ];

        $account = trim(Input::get('account'));
        if (check_email($account)) {
            $user['email'] = $account;
        } else {
            $user['name'] = $account;
        }


        if (\Auth::attempt($user)) {

            $u = \Auth::user();
            DB::table('users')
                ->where('id', $u->id)
                ->update(['last_login' => date('Y-m-d H:i:s')]);
            //触发登录事件
            event(new UserLogin(user('object')));
            //用Redirect::intended() 方法可已经将页面转向登陆前的页面。
            return redirect()->intended();
        } else {
            return Redirect::to('auth/index')->with('message', '用户名或密码错误')->withInput();
        }

    }

    /**
     * 登出
     * @return mixed
     */
    public function getLogout()
    {
        //触发登出事件
        event(new UserLogout(user('object')));

        if (\Auth::check()) {
            \Auth::logout();
        }
        return Redirect::to('auth/login')->with('message', '你已经退出登录状态。')->withInput();
    }

    /**
     * 登录页面
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return View('admin.login');
    }




    /*


    <form method="post" role="form" id="form_forgot_password" action="/admin/auth/remind">
        <div class="form-steps">
            <div class="step current" id="step-1">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"> <i class="entypo-mail"></i>
                        </div>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-login">
                        找回密码
                        <i class="entypo-right-open-mini"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>







    <!DOCTYPE html>
    <html lang="en-US">
        <head>
            <meta charset="utf-8">
        </head>
        <body>
            <h2>Password Reset</h2>

            <div>
                To reset your password, complete this form: {{ URL::to('password/reset', array($token)) }}.
            </div>
        </body>
    </html>



    */


    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        return View::make('backend.pages.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        $credentials = array(
            'user_email' => Input::get('email'),
        );
        switch ($response = Password::remind($credentials)) {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);
        return View::make('backend.pages.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );
        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        switch ($response) {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }


}
