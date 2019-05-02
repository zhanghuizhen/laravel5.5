<?php
/**
 * 后台用户控制器
 */

namespace App\Http\Controllers\Admin;

use App\Models\User as UserModel;
use App\repositories\User as UserRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params= [];
        $params['per_page'] = 10;

        $user_repo = new UserRepo();

        $list = $user_repo->getList($params);

        return view('admin/user/index', ['list' => $list]);
    }

    //根据状态筛选
    public function getListByAdmin($admin)
    {
        $params['admin'] = $admin;
        $params['per_page'] = 10;

        $user_repo = new UserRepo();

        $list = $user_repo->getList($params);

        return view('admin/user/index', ['list' => $list]);
    }

    //根据用户名筛选
    public function getListByUsername(Request $request)
    {
        $params['username'] = $request->input('username');
        $params['per_page'] = 10;

        $user_repo = new UserRepo();

        $list = $user_repo->getList($params);

        return view('admin/user/index', ['list' => $list]);
    }

    //创建
    public function store(Request $request)
    {

    }

    //更新
    public function update($id)
    {
        echo 111;
    }

    //删除
    public function delete($id)
    {
        echo 111;
    }

    //查看
    public function show($id)
    {
        $user_repo = new UserRepo();

        $user = $user_repo->getOne($id);

        if (! $user) {
            return '数据不存在';
        }

        return view('admin/user/show', ['data' => $user]);
    }

    //设为管理员
    public function setAdmin($id)
    {
        $user = UserModel::find($id);

        if (! $user) {
            return '数据不存在';
        }

        $result = $user->update(['admin' => 'yes']);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }

    //取消管理员
    public function cancelAdmin($id)
    {
        $user = UserModel::find($id);

        if (! $user) {
            return '数据不存在';
        }

        $result = $user->update(['admin' => 'no']);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }

}
