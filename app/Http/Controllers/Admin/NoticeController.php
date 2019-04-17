<?php
/**
 * 后台小区公告
 * Date: 2019/1/8
 * Time: 15:44
 */

namespace App\Http\Controllers\Admin;

use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice as NoticeModel;
use App\repositories\Notice as NoticeRepo;

class NoticeController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric|min:1',
            'title' => 'string',
            'content' => 'string',
            'state' => 'string',
            'user_id' => 'numeric|min:1',
            'publish_start_time' => 'date',
            'publish_end_time' => 'date',
            'per_page' => 'numeric',
        ]);

        $params = $request->only(['id', 'title', 'content', 'state', 'user_id',
            'publish_start_time', 'publish_end_time', 'per_page']);

        $noticeRepo =new NoticeRepo();
        $list = $noticeRepo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //创建
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'cover' => 'string',
        ],[
            'title.required' => '小区公告标题必填',
            'title.string' => 'title 应为 string 类型',
            'content.required' => '社区广场内容必填',
            'content.string' => 'content 应是 string 类型',
            'cover.string' => 'cover 应是 string类型',
        ]);

        $params = $request->only(['title', 'content', 'cover']);
        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:m:i');

        $noticeRepo = new NoticeRepo();
        $notice = $noticeRepo->store($params);

        return Response::json([
            'code' => 0,
            'data' => $notice,
        ]);
    }

    //更新
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
        ],[
            'title.required' => '小区公告标题必填',
            'title.string' => 'title 应为 string 类型',
            'content.required' => '社区广场内容必填',
            'content.string' => 'content 应是 string 类型',
        ]);

        $params = $request->only(['title', 'content']);

        $noticeRepo = new NoticeRepo();
        $noticeRepo->update($id, $params);

        return Response::json([
           'code' => 0,
        ]);
    }

    //删除
    public function delete($id)
    {
        $noticeRepo = new NoticeRepo();
        $noticeRepo->delete($id);

        return Response::json([
            'code' => 0,
        ]);
    }

    //详情
    public function show($id)
    {
        $noticeRepo = new NoticeRepo();
        $notice = $noticeRepo->getOne($id);

        return Response::json([
            'code' => 0,
            'data' => $notice,
        ]);
    }

    //发布
    public function publish($id)
    {
        $notice = NoticeModel::find($id);

        if (! $notice) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        if (! in_array($notice->state, ['offline', 'pre_published'])) {
            throw new \Exception('id为' . $id . '的数据不是下线和待发布态，不能发布');
        }

        $result = $notice->update(['state' => 'published']);

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
        $notice = NoticeModel::find($id);

        if (! $notice) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        if ($notice->state != 'published') {
            throw new \Exception('id为' . $id . '的数据不是发布态，不能下线');
        }

        $result = $notice->update(['state' => 'offline']);

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据更新失败');
        }

        return Response::json([
            'code' => 0,
        ]);
    }
}