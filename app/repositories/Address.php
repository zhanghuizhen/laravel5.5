<?php
/**
 * 小区地址
 * Date: 2019/3/6
 * Time: 11:55
 */

namespace App\repositories;
use App\Models\Address as AddressModel;

class Address extends BaseRepo
{
    //列表
    public function getList($params = [])
    {
        $query = AddressModel::orderBy('id', 'asc');

        if (! empty($params['address'])) {
            $query->where('address', 'like', '%' . $params['address'] . '%');
        }

        if (! empty($params['per_page'])) {
            $list = $query->paginate($params['per_page']);
            return $list;
        }

        $list = $query->get();
        return $list;
    }

    //获取指定id的数据的详情
    public function getOne($id)
    {
        $address = AddressModel::find($id);

        return $address;
    }

    //创建
    public function store($params)
    {
        $address = AddressModel::create($params);

        return $address;
    }

    //更新
    public function update($address, $params)
    {
        $result = $address->update($params);

        return $result;
    }

    //删除
    public function delete($address)
    {
        $result = $address->delete();

        return $result;
    }

}