<?php
/**
 * 后台报事报修控制器
 */

namespace App\Http\Controllers\Admin;

use App\Models\Repair as RepairModel;
use App\repositories\Repair as RepairRepo;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $repair_repo = new RepairRepo();
        $list = $repair_repo->getList();

        return view('admin/repair/index', ['list' => $list ]);
    }

    //详情
    public function show($id)
    {
        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($id);

        if (! $repair) {
            return '数据不存在';
        }

        return view('admin/repair/show', ['data' => $repair]);
    }

    //删除
    public function delete($id)
    {
        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($id);

        if (! $repair) {
            return '数据不存在';
        }

        $result = $repair_repo->delete($repair);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }

    //完成
    public function finish($id)
    {
        $repair = RepairModel::find($id);

        if (! $repair) {
            return '数据不存在';
        }

        if ($repair->state != 'unfinished') {
            return 'id为' . $id . '的数据不是未完成状态';
        }

        $result = $repair->update(['state' => 'finish', 'finish_time' => date('Y-m-d H:i:s')]);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }

}
