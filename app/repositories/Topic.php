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

        if (! empty($params['title'])) {
            $query->where('title', 'like', '%' . $params['title'] . '%');
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

        $per_page = $this->defaultRerPage();
        if (! empty($params['per_page'])) {
            $per_page = $params['per_page'];
        }
        $list = $query->paginate($per_page);

        return $list;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $topic = TopicModel::with('users')->find($id);

        if (! $topic) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        return $topic;
    }

    //创建
    public function store($params)
    {
        $topic = TopicModel::create($params);

        if (! $topic) {
            throw new \Exception('id为' . $topic->id . '的数据创建失败');
        }

        return $topic;
    }

    //更新
    public function update($id, $params)
    {
        $topic = TopicModel::find($id);

        if (! $topic) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        //result 为 true or false
        $result = $topic->update($params);

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据更新失败');
        }
    }

    //删除
    public function delete($id)
    {
        $topic = TopicModel::find($id);

        if (! $topic) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        $result = $topic->delete();

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据删除失败');
        }
    }

}