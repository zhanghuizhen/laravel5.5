<?php
/**
 * 后台小区公告
 * Date: 2019/1/8
 * Time: 15:44
 */

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //列表
    public function index(Request $request)
    {
        echo 111;

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