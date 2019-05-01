<?php
/**
 * 投诉建议 repo
 * Date: 2019/3/22
 * Time: 21:23
 */

namespace App\repositories;

use App\Models\Suggest as SuggestModel;

class Suggest extends BaseRepo
{
    //列表
    public function getList($params = [])
    {
        $query = SuggestModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        if (! empty($params['type'])) {
            $query->where('type', $params['type']);
        }

        if (! empty($params['per_page'])) {
            $list = $query->orderBy('published_at', 'desc')->paginate($params['per_page']);
            return $list;
        }

        $list = $query->orderBy('published_at', 'desc')->get();

        return $list;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $suggest = SuggestModel::with('users')->find($id);

        return $suggest;
    }

    //创建
    public function store($params)
    {
        $suggest = SuggestModel::create($params);

        return $suggest;
    }

    //更新
    public function update($suggest, $params)
    {
        //result 为 true or false
        $result = $suggest->update($params);

        return $result;
    }

    //删除
    public function delete($suggest)
    {
        $result = $suggest->delete();

        return $result;
    }
}