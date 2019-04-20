<?php
/**
 * 前台生活服务
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Service as ServiceRepo;
use Response;

class ServiceController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params = $request->all(['user_id']);

        $service_repo = new ServiceRepo();
        $list = $service_repo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //新建
    public function store(Request $request)
    {
        $params = $request->all(['user_address', 'type', 'express_type', 'express_num',
            'arrived_at', 'description', 'user_id']);

        $params['state'] = 'unfinished';
        $params['published_at'] = date('Y-m-d H:m:i');

        if (empty($params['user_id'])) {
            $params['user_id'] = 1;
        }

        if (empty($params['type'])) {
            return '类型不能为空';
        }

        if (empty($params['user_address'])) {
            return '小区地址不能为空';
        }

        if (empty($params['arrived_at'])) {
            return '到达时间不能为空';
        }

//        if ($params['type'] == 'express') {
//
//            if (empty($params['express_type'])) {
//                return '快递类型不能为空';
//            }
//
//            if (empty($params['express_num'])) {
//                return '快递单号不能为空';
//            }
//        }

        $service_repo = new ServiceRepo();
        $service = $service_repo->store($params);

        if (! $service) {
            return '创建数据失败';
        }

        return Response::json([
            'code' => 0,
            'data' => $service,
        ]);
    }

    //更新
    public function update(Request $request)
    {
        $params = $request->all(['id','user_address', 'type', 'arrived_at', 'description']);

        if (empty($params['id'])) {
            return '数据id不能为空';
        }

        $service_repo = new ServiceRepo();
        $service = $service_repo->getOne($params['id']);

        if (! $service) {
            return '数据不存在';
        }

        if (empty($params['type'])) {
            return '类型不能为空';
        }

        if (empty($params['user_address'])) {
            return '小区地址不能为空';
        }

        if (empty($params['arrived_at'])) {
            return '到达时间不能为空';
        }

//        if ($params['type'] == 'express') {
//
//            if (empty($params['express_type'])) {
//                return '快递类型不能为空';
//            }
//
//            if (empty($params['express_num'])) {
//                return '快递单号不能为空';
//            }
//        }

        $result = $service_repo->update($service, $params);

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

        $service_repo = new ServiceRepo();
        $service = $service_repo->getOne($id);

        if (! $service) {
            return '数据不存在';
        }

        $result = $service_repo->delete($service);

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

        $service_repo = new ServiceRepo();

        $service = $service_repo->getOne($id);

        if (! $service) {
            return '数据不存在';
        }

        return Response::json([
            'code' => 0,
            'data' => $service,
        ]);
    }
}
