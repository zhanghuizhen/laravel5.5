<?php
/**
 * 前台话题接口
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Topic as TopicRepo;
use Response;

class TopicController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params = $request->all(['state','content']);

        if (empty($params['state'])) {
            return '状态不能为空，应为published';
        }

        $topicRepo = new TopicRepo();
        $list = $topicRepo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //新建
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'string',
            'cover' => 'url',
            'user_id' => 'numeric',
        ]);

        $params = $request->only(['content', 'cover', 'user_id']);

        //$params = $request->all(['content', 'cover', 'user_id']);

        if (empty($params['content'])) {
            return '内容不能为空';
        }

        if (empty($params['user_id'])) {
            $params['user_id'] = 1;
        }

        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:m:i');

        $topicRepo = new TopicRepo();
        $topic = $topicRepo->store($params);

        if (! $topic) {
            return '创建数据失败';
        }

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }

    //更新
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric',
            'content' => 'string',
            'cover' => 'string',
            'user_id' => 'numeric',
        ]);

        $params = $request->only(['id', 'content', 'cover']);

        if (empty($params['id'])) {
            return 'id不能为空';
        }

        $topicRepo = new TopicRepo();
        $topic = $topicRepo->getOne($params['id']);

        if (! $topic) {
            return '数据不存在';
        }

        if (empty($params['content'])) {
            return '内容不能为空';
        }

        $result = $topicRepo->update($topic, $params);

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

        $topicRepo = new TopicRepo();
        $topic = $topicRepo->getOne($id);

        if (! $topic) {
            return '数据不存在';
        }

        $result = $topicRepo->delete($topic);

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

        $topicRepo = new TopicRepo();

        $topic = $topicRepo->getOne($id);

        if (! $topic) {
            return '数据不存在';
        }

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }
}
