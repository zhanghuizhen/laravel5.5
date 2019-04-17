<?php
/**
 * 小区公告 repo
 * Date: 2019/3/6
 * Time: 11:55
 */

namespace App\repositories;
use App\Models\Notice as NoticeModel;

class Notice extends BaseRepo
{
    //列表
    public function getList($params = [])
    {
        $query = NoticeModel::with('users');

        if (! empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (! empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (! empty($params['title'])) {
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }

        if (! empty($params['content'])) {
            $query->where('content', 'like', '%' . $params['content'] . '%');
        }

        if (! empty($params['state'])) {
            $query->where('state', $params['state']);
        }

        if (! empty($params['publish_start_time'])) {
            $query->where('published_at', '>=', $params['publush_start_time']);
        }

        if (! empty($params['publish_end_time'])) {
            $query->where('published_at', '<=', $params['publush_end_time']);
        }

//        $per_page = $this->defaultRerPage();
//        if (! empty($params['per_page'])) {
//            $per_page = $params['per_page'];
//        }
//        $list = $query->paginate($per_page);

        $list = $query->get();
        return $list;
    }

    //获取指定id的数据的详情
    public function getOne($id)
    {
        $notice = NoticeModel::with('users')->find($id);

        if (! $notice) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        return $notice;
    }

    //创建
    public function store($params)
    {
        $notice = NoticeModel::create($params);

        if (! $notice) {
            throw new \Exception('id为' . $notice->id .'的数据创建失败');
        }

        return $notice;
    }

    //更新
    public function update($id, $params)
    {
        $notice = NoticeModel::find($id);

        if (! $notice) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        $result = $notice->update($params);

        if (! $result) {
            throw new \Exception('id为' . $id . '的数据更新失败');
        }
    }

    //删除
    public function delete($id)
    {
        $notice = NoticeModel::find($id);

        if (! $notice) {
            throw new \Exception('id为' . $id . '的数据不存在');
        }

        $result = $notice->delete();

        if (! $result) {
            throw new \Exception('id为' . $id .'的数据删除失败');
        }

    }

}