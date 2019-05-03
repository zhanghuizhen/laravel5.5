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
        $params= [];
        $params['per_page'] = 5;

        $repair_repo = new RepairRepo();
        $list = $repair_repo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if (empty($value->description)) {
                $value->descrption = '暂无描述';
            }
        }

        return view('admin/repair/index', ['list' => $list ]);
    }

    //根据状态筛选
    public function getListByState($state)
    {
        $params['state'] = $state;
        $params['per_page'] = 5;

        $repair_repo = new RepairRepo();
        $list = $repair_repo->getList($params);

        return view('admin/repair/index', ['list' => $list ]);
    }

    //根据分类筛选
    public function getListByPart(Request $request)
    {
        $params['part'] = $request->input('part');
        $params['per_page'] = 5;

        $repair_repo = new RepairRepo();

        $list = $repair_repo->getList($params);

        return view('admin/repair/index', ['list' => $list]);
    }


    //详情
    public function show($id)
    {
        $repair_repo = new RepairRepo();
        $repair = $repair_repo->getOne($id);

        if (! $repair) {
            return '数据不存在';
        }

        if (empty($repair->description)) {
            $repair->descrption = '暂无描述';
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
