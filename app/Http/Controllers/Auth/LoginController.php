<?php
/*
 * 登录
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //重写登录
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'string',
            'password' => 'string',
        ]);

        $params = $request->only(['username', 'password']);

        if (empty($params['username'])) {
            return '用户名不能为空';
        }

        if (empty($params['password'])) {
            return '密码不能为空';
        }

        $user = UserModel::where('username', $params['username'])
            ->where('password', md5($params['password']))
            ->first();

        if (! $user) {
            return '用户名或密码错误';
        }

        session(['logined_id' => $user->id]);
        $logined_id = session('logined_id');
        if (! $logined_id) {
            return 'id  session 存储失败';
        }

        session(['logined_username' => $params['username']]);
        $logined_username = session('logined_username');
        if (! $logined_username) {
            return 'username session 存储失败';
        }

        $user->update([
            'logined_at' => date('Y-m-d H:i:s'),
        ]);

        return Response::json([
            'code' => 0,
            'logined_id' => $logined_id,
            'logined_username' => $logined_username,
            'logined_at' => $user->logined_at,
        ]);
    }



}
