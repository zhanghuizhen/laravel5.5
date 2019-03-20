<?php
/**
 * 后台用户控制器
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //列表
    public function index(Request $request)
    {

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
