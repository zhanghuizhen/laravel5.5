<?php

namespace App\Http\Controllers\Home;

use App\repositories\Repair as RepairRepo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params = $request->all(['user_id']);

        $repair_repo = new RepairRepo();
        $list = $repair_repo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //详情
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return 'id不能为空';
        }

        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($id);

        if (! $repair) {
            return '数据不存在';
        }

        return Response::json([
            'code' => 0,
            'data' => $repair,
        ]);
    }

    //创建
    public function store(Request $request)
    {
        $params = $request->all(['address', 'part', 'repair_time', 'description',  'user_id']);

        if (empty($params['address'])) {
            return '报修地址不能为空';
        }

        if (empty($params['part'])) {
            return '报修分类不能为空';
        }

        if (empty($params['repair_time'])) {
            return '接待时间不能为空';
        }

        if (empty($params['user_id'])) {
            $params['user_id'] = 1;
        }

        $image = $request->file('image');
        $fileName = md5(time().rand(0,10000)).'.'.$image->getClientOriginalName();
        $path = '/'.$fileName;

        Storage::put($path,File::get($image));

        if(Storage::exists($path)){
            $params['image'] = 'http://140.143.6.115:80/img'.$path;
        }

        $params['state'] = 'unfinished';
        $params['published_at'] = date('Y-m-d H:i:s');

        $repair_repo = new RepairRepo();
        $repair = $repair_repo->store($params);

        if (! $repair) {
            return '创建失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //更新
    public function update(Request $request)
    {
        $params = $request->all(['id', 'address', 'part', 'repair_time', 'description']);

        if (empty($params['id'])) {
            return '数据id不能为空';
        }

        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($params['id']);
        if (! $repair) {
            return '数据不存在';
        }

        if (empty($params['address'])) {
            return '报修地址不能为空';
        }

        if (empty($params['part'])) {
            return '报修分类不能为空';
        }

        if (empty($params['repair_time'])) {
            return '接待时间不能为空';
        }

        $image = $request->file('image');
        $fileName = md5(time().rand(0,10000)).'.'.$image->getClientOriginalName();
        $path = '/'.$fileName;

        Storage::put($path,File::get($image));

        if(Storage::exists($path)){
            $params['image'] = 'http://140.143.6.115:80/img'.$path;
        }

        $result = $repair_repo->update($repair, $params);

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

        $repair_repo = new RepairRepo();

        $repair = $repair_repo->getOne($id);
        if (! $repair) {
            return '数据不存在';
        }

        $result = $repair_repo->delete($repair);
        if (! $result) {
            return '删除失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

}
