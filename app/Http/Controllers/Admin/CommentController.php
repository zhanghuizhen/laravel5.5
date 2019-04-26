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
    //查看
    public function show($id)
    {
        $comment_repo = new CommentRepo();

        $comment = $comment_repo->getOne($id);

        if (! $comment) {
            return '数据不存在';
        }

        return view('admin/comment/show', ['data' => $comment]);
    }

    //删除
    public function delete($id)
    {
        $comment_repo = new CommentRepo();

        $comment = $comment_repo->getOne($id);

        if (! $comment) {
            return '数据不存在';
        }

        $result = $comment_repo->delete($comment);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }

}
