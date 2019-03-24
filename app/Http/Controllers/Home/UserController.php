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
    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'username' => 'string',
            'avatar_url' => 'string',
            'address' => 'string',
        ]);

        $params = $request->only(['username', 'avatar_url', 'address']);

        $user_repo = new UserRepo();
        $user_repo->edit($id, $params);

        return Response::json([
            'code' => 0,
            'msg' => '编辑个人资料成功',
        ]);
    }

    //查看个人资料
    public function show($id)
    {
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
//var_dump($user_id);die;
        $user_repo = new UserRepo();
        $topic = $user_repo->getUserTopic($user_id);

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }
}
