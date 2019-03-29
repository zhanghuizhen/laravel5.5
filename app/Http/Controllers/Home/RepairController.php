<?php

namespace App\Http\Controllers\Home;

use App\repositories\Repair as RepairRepo;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric',
            'user_id' => 'numeric',
            'part' => 'string',
            'state' => 'string',
            'address' => 'string',
            'per_page' => 'numeric',
        ]);

        $params = $request->only(['id', 'user_id', 'part', 'state', 'address', 'per_page']);

        $repair_repo = new RepairRepo();
        $list = $repair_repo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //详情
    public function show($id)
    {
        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($id);

        return Response::json([
            'code' => 0,
            'data' => $repair,
        ]);
    }

    //创建
    public function store(Request $request)
    {
        $this->validate($request, [
            'part' => 'required|string',
            'description' => 'required|string',
            'address' => 'string',
            'repair_time' => 'string',
        ]);

        $params = $request->only(['part', 'description', 'address', 'repair_time']);
        $params['state'] = 'unfinished';

        $user_id = session('logined_id');
        $params['user_id'] = $user_id;

        $repair_repo = new RepairRepo();
        $repair = $repair_repo->store($params);

        return Response::json([
            'code' => 0,
            'data' => $repair,
        ]);
    }

    //更新
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'part' => 'string',
            'description' => 'string',
            'address' => 'string',
            'repair_time' => 'string',
        ]);

        $params = $request->only(['part', 'description', 'address', 'repair_time']);

        $user_id = session('logined_id');
        $params['user_id'] = $user_id;

        $repair_repo = new RepairRepo();
        $repair_repo->update($id, $params);

        return Response::json([
            'code' => 0,
        ]);
    }

}
