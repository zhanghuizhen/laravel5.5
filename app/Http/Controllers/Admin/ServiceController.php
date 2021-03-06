<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service as ServiceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Service as ServiceRepo;

class ServiceController extends Controller
{
    //列表
    public function index()
    {
        $params= [];
        $params['per_page'] = 10;

        $service_repo = new ServiceRepo();
        $list = $service_repo->getList($params);

        foreach ($list as $value) {

            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->description = '暂无描述';
            }
        }

        return view('admin/service/index', ['list' => $list]);
    }

    //根据状态筛选
    public function getListByState($state)
    {
        $params['state'] = $state;
        $params['per_page'] = 10;

        $service_repo = new ServiceRepo();
        $list = $service_repo->getList($params);

        foreach ($list as $value) {

            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->description = '暂无描述';
            }
        }

        return view('admin/service/index', ['list' => $list]);
    }

    //根据类型筛选
    public function getListByType($type)
    {
        $params['type'] = $type;
        $params['per_page'] = 10;

        $service_repo = new ServiceRepo();
        $list = $service_repo->getList($params);

        foreach ($list as $value) {

            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->description = '暂无描述';
            }
        }

        return view('admin/service/index', ['list' => $list]);
    }

    //详情
    public function show($id)
    {
        $service_repo = new ServiceRepo();
        $service = $service_repo->getOne($id);

        if (! $service) {
            return '数据不存在';
        }

        if (empty($service->description)) {
            $service->description = '暂无描述';
        }

        return view('admin/service/show', ['data' => $service]);
    }

    //删除
    public function delete($id)
    {
        $service_repo = new ServiceRepo();
        $service = $service_repo->getOne($id);

        if (! $service) {
            return '数据不存在';
        }

        $result = $service_repo->delete($service);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }

    //完成
    public function finish($id)
    {
        $service = ServiceModel::find($id);

        if (! $service) {
            return '数据不存在';
        }

        if ($service->state != 'unfinished') {
            return 'id为' . $id . '的数据不是未完成状态';
        }

        $result = $service->update(['state' => 'finish', 'finish_time' => date('Y-m-d H:i:s')]);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }
}
