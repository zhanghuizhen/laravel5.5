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
    public function getList($params)
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

        $per_page = $this->defaultRerPage();
        if (! empty($params['per_page'])) {
            $per_page = $params['per_page'];
        }
        $list = $query->paginate($per_page);

        return $list;
    }

    //获取指定id的数据的详情
    public function getOne($id)
    {
        $repair = RepairModel::with('users')->find($id);

        if (! $repair) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        return $repair;
    }

    //



}