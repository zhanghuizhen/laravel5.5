<?php

namespace App\Http\Controllers\Home;

use App\Models\User as UserModel;
use App\repositories\User as UserRepo;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //编辑个人资料
    public function edit(Request $request)
    {
        $params = $request->all(['id', 'introduction', 'avatar_url',
            'address', 'phone', 'username', 'cover']);

        if (empty($params['id'])) {
            return '用户id不能为空';
        }

        $user_repo = new UserRepo();

        $user = $user_repo->getOne($params['id']);

        if (empty($user)) {
            return '用户不存在';
        }

        $result = $user_repo->edit($user, $params);

        if (! $result) {
            return '编辑个人资料失败';
        }

        return Response::json([
            'code' => 0,
            'msg' => '编辑个人资料成功',
        ]);
    }

    //查看个人资料
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return '用户id不能为空';
        }

        $user_repo = new UserRepo();
        $user = $user_repo->getOne($id);

        return Response::json([
            'code' => 0,
            'data' => $user,
        ]);
    }

    //查看发表过的话题
    public function getUserTopic()
    {
        $user_id = session('logined_id');
        if (empty($user_id)) {
            throw new \Exception('user_id为空');
        }

        $user_repo = new UserRepo();
        $topic = $user_repo->getUserTopic($user_id);

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }
}
