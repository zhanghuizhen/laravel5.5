<?php
/**
 * 生活服务
 * Date: 2019/4/1
 * Time: 21:16
 */

namespace App\repositories;

use App\Models\Service as ServiceModel;

class Service extends BaseRepo
{
//列表
    public function getList($params = [])
    {
        $query = ServiceModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['type'])) {
            $query->where('type', $params['type']);
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        $list = $query->orderBy('published_at', 'desc')->get();

        return $list;
    }

    //获取指定id的数据详情
    public function getOne($id)
    {
        $service = ServiceModel::with('users')->find($id);

        return $service;
    }

    //创建
    public function store($params)
    {
        $service = ServiceModel::create($params);

        return $service;
    }

    //更新
    public function update($service, $params)
    {
        //result 为 true or false
        $result = $service->update($params);

        return $result;
    }

    //删除
    public function delete($service)
    {
        $result = $service->delete();

        return $result;
    }

}