<?php
/**
 * 社区广场repo
 * Date: 2019/3/21
 * Time: 19:19
 */

namespace App\repositories;

use App\Models\Topic as TopicModel;

class Topic extends BaseRepo
{
    //列表
    public function getList($params = [])
    {
        $query = TopicModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['content'])) {
            $query->where('content', 'like', '%' . $params['content'] . '%');
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        if (! empty($params['publish_start_time'])) {
            $query->where('published_at', '>=', $params['publush_start_time']);
        }

        if (! empty($params['publish_end_time'])) {
            $query->where('published_at', '<=', $params['publush_end_time']);
        }

        if (! empty($params['per_page'])) {
            $list = $query->orderBy('published_at', 'desc')->paginate($params['per_page']);
            return $list;
        }

        $list = $query->orderBy('published_at', 'desc')->get();

        return $list;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $topic = TopicModel::with('users')->find($id);

        return $topic;
    }

    //创建
    public function store($params)
    {
        $topic = TopicModel::create($params);

        return $topic;
    }

    //更新
    public function update($topic, $params)
    {
        //result 为 true or false
        $result = $topic->update($params);

        return $result;
    }

    //删除
    public function delete($topic)
    {
        $result = $topic->delete();

        return $result;
    }

}