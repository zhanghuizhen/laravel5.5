<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\repositories\Notice as NoticeRepo;

class NoticeController extends Controller
{
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
}
