<?php
/**
 * 用户 repo
 * Date: 2019/3/24
 * Time: 10:23
 */

namespace App\repositories;

use App\Models\User as UserModel;
use App\Models\Topic as TopicModel;

class User extends BaseRepo
{
    //编辑个人资料
    public function edit($user, $params)
    {
        $result = $user->update($params);

        return $result;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $user = UserModel::find($id);

        return $user;

    }

    //获取用户列表
    public function getList($params)
    {

    }

    //查看指定用户发表过的话题
    public function getUserTopic($user_id)
    {
        $user = UserModel::find($user_id);
        if (! $user) {
            throw new \Exception('该用户不存在');
        }

        $topic = TopicModel::where('user_id', $user_id)->get();

        return $topic;
    }
}