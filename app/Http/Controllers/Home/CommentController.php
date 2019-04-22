<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Comment as CommentRepo;
use App\repositories\Topic as TopicRepo;
use Response;

class CommentController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params = $request->all(['state', 'topic_id']);

        if (empty($params['state'])) {
            return '状态不能为空';
        }

        $comment_repo = new CommentRepo();
        $list = $comment_repo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //新建
    public function store(Request $request)
    {
        $params = $request->all(['content', 'root_id', 'parent_id', 'user_id', 'topic_id']);

        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:m:i');

        if (empty($params['user_id'])) {
            $params['user_id'] = 1;
        }

        if (empty($params['content'])) {
            return '评论内容不能为空';
        }

        if (empty($params['topic_id'])) {
            return '社区广场数据id不能为空';
        }

        $topicRepo = new TopicRepo();

        $topic = $topicRepo->getOne($params['topic_id']);

        if (! $topic) {
            return '话题数据不存在';
        }

        $comment_repo = new CommentRepo();
        $comment = $comment_repo->store($params);

        if (! $comment) {
            return '创建数据失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //更新
    public function update(Request $request)
    {
        $params = $request->all(['content', 'id']);

        if (empty($params['id'])) {
            return '数据id不能为空';
        }

        $comment_repo = new CommentRepo();
        $comment = $comment_repo->getOne($params['id']);

        if (! $comment) {
            return '数据不存在';
        }

        if (empty($params['content'])) {
            return '评论内容不能为空';
        }

        $result = $comment_repo->update($comment, $params);

        if (! $result) {
            return '更新失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //删除
    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return 'id不能为空';
        }

        $comment_repo = new CommentRepo();
        $comment = $comment_repo->getOne($id);

        if (! $comment) {
            return '数据不存在';
        }

        $result = $comment_repo->delete($comment);

        if (! $result) {
            return '数据删除失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //查看
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return 'id不能为空';
        }

        $comment_repo = new CommentRepo();

        $comment = $comment_repo->getOne($id);

        if (! $comment) {
            return '数据不存在';
        }

        return Response::json([
            'code' => 0,
            'data' => $comment,
        ]);
    }
}
