<?php
/**
 * 评论
 * Date: 2019/4/1
 * Time: 21:18
 */

namespace App\repositories;
use App\Models\Comment as CommentModel;

class Comment
{
    //列表
    public function getList($params = [])
    {
        $query = CommentModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['root_id'])) {
            $query->where('root_id', $params['root_id']);
        }

        if (! empty($params['topic_id'])) {
            $query->where('topic_id', $params['topic_id']);
        }

        if (! empty($params['content'])) {
            $query->where('content', 'like', '%' . $params['content'] . '%');
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        $list = $query->orderBy('published_at', 'desc')->get();

        return $list;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $comment = CommentModel::with('users')->find($id);

        return $comment;
    }

    //创建
    public function store($params)
    {
        $comment = CommentModel::create($params);

        return $comment;
    }

    //更新
    public function update($comment, $params)
    {
        //result 为 true or false
        $result = $comment->update($params);

        return $result;
    }

    //删除
    public function delete($comment)
    {
        $result = $comment->delete();

        return $result;
    }
}