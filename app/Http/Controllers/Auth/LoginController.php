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
            'phone' => 'required|numeric',
            'password' => 'required|string',
        ]);

        $params = $request->only(['phone', 'password']);

        $user = UserModel::where('phone', $params['phone'])
            ->where('password', md5($params['password']))
            ->first();

        if (! $user) {
            throw new \Exception('用户名或密码错误');
        }

        session(['logined_id' => $user->id]);
        $logined_id = session('logined_id');
        if (! $logined_id) {
            throw new \Exception('id  session 存储失败');
        }

        session(['logined_phone' => $params['phone']]);
        $logined_phone = session('logined_phone');
        if (! $logined_phone) {
            throw new \Exception('phone session 存储失败');
        }

        $user->update([
            'logined_at' => date('Y-m-d H:i:s'),
        ]);

        return Response::json([
            'code' => 0,
            'logined_id' => $logined_id,
            'logined_phone' => $logined_phone,
        ]);
    }



}
