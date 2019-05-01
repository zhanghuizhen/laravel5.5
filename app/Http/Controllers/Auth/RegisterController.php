<?php
/*
 * 注册
 */
namespace App\Http\Controllers\Auth;

use App\Models\User as UserModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //展示注册页面
    public function registerView()
    {
        return view('admin/auth/register');
    }

    //后台注册
    public function adminRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'string',
            'password' => 'string',
            're_password' => 'string',
        ]);

        $params = $request->only(['username', 'password', 're_password']);

        if (empty($params['username'])) {
            return '用户名不能为空';
        }

        if (empty($params['password'])) {
            return '密码不能为空';
        }

        if (empty($params['re_password'])) {
            return '确认密码不能为空';
        }

        $username_user = UserModel::where('username', $params['username'])->first();
        if ($username_user) {
            return '该用户名已被注册';
        }

        if ($params['password'] != $params['re_password']) {
            return '密码不一致';
        }

        unset($params['re_password']);

        $params['password'] = md5($params['password']);
        $params['admin'] = 'yes';

        $user = UserModel::create($params);
        if (! $user) {
            return '创建失败';
        }

        return redirect('auth/login');
    }


    //重写注册
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'string',
            'password' => 'string',
            're_password' => 'string',
        ]);

        $params = $request->only(['username', 'password', 're_password']);

        if (empty($params['username'])) {
            return '用户名不能为空';
        }

        if (empty($params['password'])) {
            return '密码不能为空';
        }

        if (empty($params['re_password'])) {
            return '确认密码不能为空';
        }

        $username_user = UserModel::where('username', $params['username'])->first();
        if ($username_user) {
            return '该用户名已被注册';
        }

        if ($params['password'] != $params['re_password']) {
            return '密码不一致';
        }

        unset($params['re_password']);

        $params['password'] = md5($params['password']);
        $params['admin'] = 'no';

        $user = UserModel::create($params);
        if (! $user) {
            return '创建失败';
        }

        return Response::json([
            'code' => 0,
            'data' => $user,
        ]);
    }
}
