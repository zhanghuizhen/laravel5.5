<?php
/**
 * 后台投诉建议控制器
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric|min:1',
            'content' => 'string',
            'state' => 'string',
            'type' => 'string',
        ]);

        $params = $request->only(['id', 'content', 'state', 'type']);


    }

    //创建
    public function store(Request $request)
    {

    }

    //更新
    public function update($id)
    {
        echo 111;
    }

    //删除
    public function delete($id)
    {
        echo 111;
    }

}
