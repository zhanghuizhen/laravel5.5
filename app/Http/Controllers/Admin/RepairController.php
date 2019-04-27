<?php
/**
 * 后台报事报修控制器
 */

namespace App\Http\Controllers\Admin;

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

}
