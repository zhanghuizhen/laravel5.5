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
        $suggest_repo = new SuggestRepo();
        $list = $suggest_repo->getList();

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
