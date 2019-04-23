<?php
/**
 * 后台话题控制器（社区广场）
 * Date: 2019/1/7
 * Time: 18:08
 */

namespace App\Http\Controllers\Admin;

use Response;

use App\repositories\Topic as TopicRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic as TopicModel;

class TopicController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $topicRepo = new TopicRepo();
        $list = $topicRepo->getList();

        return view('admin/topic/index', ['list' => $list ]);
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

    //发布
    public function publish($id)
    {
        $topic = TopicModel::find($id);

        if (! $topic) {
            throw new \Exception('id为' . $id . '的社区广场数据不存在');
        }

        if (! in_array($topic->state, ['offline', 'pre_published'])) {
            throw new \Exception('id为' . $id . '的社区广场数据不是下线和待发布态，不能发布');
        }

        $result = $topic->update(['state' => 'published']);

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据更新失败');
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //下线
    public function offline($id)
    {
        $topic = TopicModel::find($id);

        if (! $topic) {
            throw new \Exception('id为' . $id . '的社区广场数据不存在');
        }

        if ($topic->state != 'published') {
            throw new \Exception('id为' . $id . '的社区广场数据不是发布态，不能下线');
        }

        $result = $topic->update(['state' => 'offline']);

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据更新失败');
        }

        return Response::json([
            'code' => 0,
        ]);
    }

}