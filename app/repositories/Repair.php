<?php
/**
 * repair 报事报修
 * Date: 2019/3/27
 * Time: 20:06
 */

namespace App\repositories;

use App\Models\Repair as RepairModel;

class Repair extends BaseRepo
{
    //列表
    public function getList($params = [])
    {
        $query = RepairModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['part'])) {
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        if (! empty($params['address'])) {
            $query->where('address', 'like', '%' . $params['address'] . '%');
        }

//        $per_page = $this->defaultRerPage();
//        if (! empty($params['per_page'])) {
//            $per_page = $params['per_page'];
//        }
//        $list = $query->paginate($per_page);

        $list = $query->orderBy('published_at', 'desc')->get();

        return $list;
    }

    //获取指定id的数据的详情
    public function getOne($id)
    {
        $repair = RepairModel::with('users')->find($id);

        return $repair;
    }

    //创建
    public function store($params)
    {
        $repair = RepairModel::create($params);

        return $repair;
    }

    //更新
    public function update($repair, $params)
    {
        //result 为 true or false
        $result = $repair->update($params);

        return $result;
    }

    //删除
    public function delete($repair)
    {
        $result = $repair->delete();

        return $result;
    }

}