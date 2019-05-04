<?php
/**
 * 后台投诉建议控制器
 */

namespace App\Http\Controllers\Admin;

use App\repositories\Suggest as SuggestRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class SuggestController extends Controller
{
    //列表
    public function index()
    {
        $params= [];
        $params['per_page'] = 5;

        $suggest_repo = new SuggestRepo();
        $list = $suggest_repo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->descrption = '暂无描述';
            }
        }

        return view('admin/suggest/index', ['list' => $list]);
    }

    //根据状态筛选
    public function getListByState($state)
    {
        $params['state'] = $state;
        $params['per_page'] = 5;

        $suggest_repo =new SuggestRepo();
        $list = $suggest_repo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->descrption = '暂无描述';
            }
        }

        return view('admin/suggest/index', ['list' => $list ]);
    }

    //根据内容筛选
    public function getListByDescription(Request $request)
    {
        $params['description'] = $request->input('description');
        $params['per_page'] = 5;

        $suggest_repo = new SuggestRepo();
        $list = $suggest_repo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->description);
            if ($length >= 10) {
                $value->description = mb_substr($value->description, 0 , 20, "UTF-8") . '……';
            }

            if ($length <= 0) {
                $value->descrption = '暂无描述';
            }
        }

        return view('admin/suggest/index', ['list' => $list]);
    }

    //详情
    public function show($id)
    {
        $suggest_repo = new SuggestRepo();
        $suggest = $suggest_repo->getOne($id);

        if (! $suggest) {
            return '数据不存在';
        }

        if (empty($suggest->description)) {
            $suggest->descrption = '暂无描述';
        }

        return view('admin/suggest/show', ['data' => $suggest]);
    }

    //删除
    public function delete($id)
    {
        $suggest_repo = new SuggestRepo();
        $suggest = $suggest_repo->getOne($id);

        if (! $suggest) {
            return '数据不存在';
        }

        $result = $suggest_repo->delete($suggest);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }
}
