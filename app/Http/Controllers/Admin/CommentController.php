<?php
/**
 * 后台评论控制器
 */

namespace App\Http\Controllers\Admin;

use App\repositories\Comment as CommentRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //列表
    public function index()
    {
        $comment_repo = new CommentRepo();

        $list = $comment_repo->getList();

        return view('admin/comment/index', ['list' => $list]);
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
