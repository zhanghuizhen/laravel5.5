<?php
/**
 * 前台小区公告
 */

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
            'state' => 'string',
            'per_page' => 'numeric',
        ]);

        $params = $request->only(['state', 'per_page']);

        $noticeRepo =new NoticeRepo();
        $list = $noticeRepo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }
}
