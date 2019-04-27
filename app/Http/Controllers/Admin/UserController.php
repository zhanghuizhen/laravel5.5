<?php
/**
 * 后台用户控制器
 */

namespace App\Http\Controllers\Admin;

use App\repositories\User as UserRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $user_repo = new UserRepo();

        $list = $user_repo->getList();

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

}
