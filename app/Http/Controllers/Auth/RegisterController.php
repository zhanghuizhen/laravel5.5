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

    //重写注册
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:25',
            'phone' => 'required|numeric',
            'password' => 'required|string|max:10',
        ],[
            'username.required' => '用户名必填',
            'username.string' => 'username 应是 string 类型',
            'username.max' => '用户名最大长度为25位',
            'phone.required' => '手机号必填',
            'phone.string' => 'phone 应是 string 类型',
            'password.required' => '密码必填',
            'password.string' => 'password 应为 string 类型',
            'password.max' => '密码最大长度为10位',
        ]);

        $params = $request->only(['username', 'phone', 'password']);

        $user_name_user = UserModel::where('username', $params['username'])->first();
        if ($user_name_user) {
            throw new \Exception('该用户名已被占用');
        }

        $phone_user = UserModel::where('phone', $params['phone'])->first();
        if ($phone_user) {
            throw new \Exception('该手机号已被注册');
        }

        $params['password'] = md5($params['password']);

        $user = UserModel::create($params);
        if (! $user) {
            throw new \Exception('创建失败');
        }

        return Response::json([
            'code' => 0,
            'data' => $user,
        ]);
    }
}
