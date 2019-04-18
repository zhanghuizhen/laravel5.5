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
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return 'id不能为空';
        }

        $noticeRepo = new NoticeRepo();
        $notice = $noticeRepo->getOne($id);

        if (empty($notice)) {
            return '数据不存在';
        }

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
        ]);

        $params = $request->only(['state']);

        if (empty($params['state'])) {
            return '状态参数不能为空';
        }

        $noticeRepo =new NoticeRepo();
        $list = $noticeRepo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }
}
