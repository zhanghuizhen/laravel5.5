<?php
/**
 * 后台评论控制器
 */

namespace App\Http\Controllers\Admin;

use App\Models\Comment as CommentModel;
use App\repositories\Comment as CommentRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //列表
    public function index()
    {
        $params= [];
        $params['per_page'] = 10;

        $comment_repo = new CommentRepo();

        $list = $comment_repo->getList($params);

        return view('admin/comment/index', ['list' => $list]);
    }

    //根据状态筛选
    public function getListByState($state)
    {
        $params['state'] = $state;
        $params['per_page'] = 10;

        $comment_repo = new CommentRepo();

        $list = $comment_repo->getList($params);

        //$list = CommentModel::where('state', $state)->get();

        return view('admin/comment/index', ['list' => $list]);
    }

    //根据内容筛选
    public function getListByContent(Request $request)
    {
        $params['content'] = $request->input('content');
        $params['per_page'] = 10;

        $comment_repo = new CommentRepo();

        $list = $comment_repo->getList($params);

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

    //发布
    public function publish($id)
    {
        $comment = CommentModel::find($id);

        if (! $comment) {
            return '数据不存在';
        }

        if ($comment->state != 'offline') {
            return 'id为' . $id . '的数据不是下线状态，不能发布';
        }

        $result = $comment->update(['state' => 'published']);

        if ($result){
            return 'ok';
        }else{
            return 'false';
        }
    }

    //下线
    public function offline($id)
    {
        $comment = CommentModel::find($id);

        if (! $comment) {
            return '数据不存在';
        }

        if ($comment->state != 'published') {
            return 'id为' . $id . '的数据不是发布态，不能下线';
        }

        $result = $comment->update(['state' => 'offline']);

        if ($result){
            return 'ok';
        }else{
            return 'false';
        }
    }

}
