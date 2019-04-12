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
        $this->validate($request, [
            'state' => 'string',
            'per_page' => 'numeric',
        ]);

        $params = $request->only('state', 'per_page');

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
            'title' => 'required|string',
            'content' => 'required|string',
            'cover' => 'url',
        ],[
            'title.required' => '社区广场标题必填',
            'title.string' => 'title 应是 string 类型',
            'content.required' => '社区广场内容必填',
            'content.string' => 'content 应是 string 类型',
            'cover.url' => 'cover 应是 url',
        ]);

        $params = $request->only(['title', 'content', 'cover']);
        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:m:i');

        $user_id = session('logined_id');
        $params['user_id'] = $user_id;
        if (empty($params)) {
            $params['user_id'] = 1;
        }

        $topicRepo = new TopicRepo();
        $topic = $topicRepo->store($params);

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }

    //更新
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'cover' => 'url',
        ],[
            'title.required' => '社区广场标题必填',
            'title.string' => 'title 应是 string 类型',
            'content.required' => '社区广场内容必填',
            'content.string' => 'content 应是 string 类型',
            'cover.url' => 'cover 应是 url',
        ]);

        $params = $request->only(['title', 'content', 'cover']);

        $topicRepo = new TopicRepo();
        $topicRepo->update($id, $params);

        return Response::json([
            'code' => 0,
        ]);
    }

    //删除
    public function delete($id)
    {
        $topicRepo = new TopicRepo();
        $topicRepo->delete($id);

        return Response::json([
            'code' => 0,
        ]);
    }

    //查看
    public function show($id)
    {
        $topicRepo = new TopicRepo();

        $topic = $topicRepo->getOne($id);

        return Response::json([
            'code' => 0,
            'data' => $topic,
        ]);
    }
}
