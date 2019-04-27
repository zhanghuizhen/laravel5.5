<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Service as ServiceRepo;

class ServiceController extends Controller
{
    //列表
    public function index()
    {
        $service_repo = new ServiceRepo();
        $list = $service_repo->getList();

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
}
