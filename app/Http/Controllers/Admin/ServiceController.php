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
}
