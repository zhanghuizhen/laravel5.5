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
}
