<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Address as AddressRepo;

class AddressController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params= [];
        $params['per_page'] = 10;

        $addressRepo =new AddressRepo();
        $list = $addressRepo->getList($params);

        return view('admin/address/index', ['list' => $list ]);
    }

    //根据地址筛选
    public function getListByAddress(Request $request)
    {
        $params['address'] = $request->input('address');
        $params['per_page'] = 10;

        $address_repo = new AddressRepo();
        $list = $address_repo->getList($params);

        return view('admin/address/index', ['list' => $list]);
    }

    //展示创建页面
    public function showCreate()
    {
        return view('admin.address.create');

    }

    //创建
    public function store(Request $request)
    {
        $params = $request->all(['address']);

        $addressRepo = new AddressRepo();
        $address = $addressRepo->store($params);

        if (! $address) {
            return view('admin/address/create');
        }

        return view('admin/address/show', ['data' => $address]);
    }

    //展示更新页面
    public function edit($id)
    {
        $addressRepo = new AddressRepo();

        $address = $addressRepo->getOne($id);

        if (! $address) {
            return '数据不存在';
        }

        return view('admin/address/edit', ['data' => $address]);
    }

    //更新
    public function update($id, Request $request)
    {
        $params = $params = $request->all([ 'address']);

        $addressRepo = new AddressRepo();

        $address = $addressRepo->getOne($id);

        if (! $address) {
            return '数据不存在';
        }

        $result = $addressRepo->update($address, $params);

        if (! $result) {
            return view('admin/address/update');
        }

        return view('admin.address.show', ['data' => $address]);
    }

    //删除
    public function delete($id)
    {
        $addressRepo = new AddressRepo();

        $address = $addressRepo->getOne($id);

        if (! $address) {
            return '数据不存在';
        }

        $result = $addressRepo->delete($address);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }

    //详情
    public function show($id)
    {
        $addressRepo = new AddressRepo();
        $address = $addressRepo->getOne($id);

        if (! $address) {
            return '数据不存在';
        }

        return view('admin/address/show', ['data' => $address]);
    }

}
