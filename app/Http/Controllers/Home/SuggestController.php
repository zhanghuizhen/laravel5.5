<?php

namespace App\Http\Controllers\Home;

use App\repositories\Suggest as SuggestRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class SuggestController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params = $request->all(['user_id']);

        $suggest_repo = new SuggestRepo();

        $list = $suggest_repo->getList($params);

        return Response::json([
            'code' => 0,
            'data' => $list,
        ]);
    }

    //创建
    public function store(Request $request)
    {
        $params = $request->all(['address', 'type', 'image', 'description', 'user_id']);

        if (empty($params['address'])) {
            return '小区地址不能为空';
        }

        if (empty($params['type'])) {
            return '分类不能为空';
        }

        if (empty($params['user_id'])) {
            $params['user_id'] = 1;
        }

        if (empty($params['description'])) {
            return '问题描述不能为空';
        }

        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:m:i');

        $suggest_repo = new SuggestRepo();
        $suggest = $suggest_repo->store($params);

        if (! $suggest) {
            return '创建失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //更新
    public function update(Request $request)
    {
        $params = $request->all(['address', 'type', 'image', 'description', 'id']);

        if (empty($params['id'])) {
            return 'id不能为空';
        }

        $suggest_repo = new SuggestRepo();
        $suggest = $suggest_repo->getOne($params['id']);
        if (! $suggest) {
            return '数据不存在';
        }

        if (empty($params['address'])) {
            return '小区地址不能为空';
        }

        if (empty($params['type'])) {
            return '分类不能为空';
        }

        if (empty($params['description'])) {
            return '问题描述不能为空';
        }

        $result = $suggest_repo->update($suggest, $params);

        if (! $result) {
            return '更新失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //删除
    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return '数据id不能为空';
        }

        $suggest_repo = new SuggestRepo();

        $suggest = $suggest_repo->getOne($id);

        if (! $suggest) {
            return '数据不存在';
        }

        $result = $suggest_repo->delete($suggest);

        if (! $result) {
            return '删除失败';
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    //详情
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return 'id不能为空';
        }

        $suggest_repo = new SuggestRepo();

        $suggest = $suggest_repo->getOne($id);

        if (! $suggest) {
            return '数据不存在';
        }

        return Response::json([
            'code' => 0,
            'data' => $suggest,
        ]);
    }

}
