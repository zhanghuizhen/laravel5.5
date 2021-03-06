<?php
/**
 * 后台小区公告
 * Date: 2019/1/8
 * Time: 15:44
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice as NoticeModel;
use App\repositories\Notice as NoticeRepo;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    //列表
    public function index(Request $request)
    {
        $params= [];
        $params['per_page'] = 5;

        $noticeRepo =new NoticeRepo();
        $list = $noticeRepo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->content);
            if ($length >= 10) {
                $value->content = mb_substr($value->content, 0 , 20, "UTF-8") . '……';
            }
        }

        return view('admin/notice/index', ['list' => $list ]);
    }

    //根据状态筛选
    public function getListByState($state)
    {
        $params['state'] = $state;
        $params['per_page'] = 5;

        $noticeRepo =new NoticeRepo();
        $list = $noticeRepo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->content);
            if ($length >= 10) {
                $value->content = mb_substr($value->content, 0 , 20, "UTF-8") . '……';
            }
        }

        return view('admin/notice/index', ['list' => $list ]);
    }

    //根据内容筛选
    public function getListByContent(Request $request)
    {
        $params['content'] = $request->input('content');
        $params['per_page'] = 5;

        $notice_repo = new NoticeRepo();
        $list = $notice_repo->getList($params);

        foreach ($list as $value) {
            $length = mb_strlen($value->content);
            if ($length >= 10) {
                $value->content = mb_substr($value->content, 0 , 20, "UTF-8") . '……';
            }
        }

        return view('admin/notice/index', ['list' => $list]);
    }

    public function showCreate()
    {
        return view('admin.notice.create');

    }

//    //展示创建页面
//    public function create()
//    {
//        return view('admin.notice.create');
//    }

    //创建
    public function store(Request $request)
    {
        $params = $request->all(['title', 'content', 'address', 'user_id']);

        $cover = $request->file('cover');

        if (! empty($cover)) {

            $fileName = md5(time().rand(0,10000)).'.'.$cover->getClientOriginalName();
            $path = '/'.$fileName;

            Storage::put($path,File::get($cover));

            if(Storage::exists($path)){
                $params['cover'] = 'http://188.131.192.194:83/img'.$path;
            }
        }

        $params['state'] = 'published';
        $params['published_at'] = date('Y-m-d H:i:s');

        $user_id = session('logined_id');
        if (empty($user_id)) {
            $params['user_id'] = 1;
        } else {
            $params['user_id'] = session('logined_id');
        }

        $noticeRepo = new NoticeRepo();
        $notice = $noticeRepo->store($params);

        if (! $notice) {
            return view('admin/notice/create');
        }

        return view('admin/notice/show', ['data' => $notice]);
    }

    //展示更新页面
    public function edit($id)
    {
        $noticeRepo = new NoticeRepo();

        $notice = $noticeRepo->getOne($id);

        if (! $notice) {
            return '数据不存在';
        }

        return view('admin/notice/edit', ['data' => $notice]);
    }

    //更新
    public function update($id, Request $request)
    {
        $params = $params = $request->all(['title', 'content', 'address']);

        $cover = $request->file('cover');

        if (! empty($cover)) {
            $fileName = md5(time().rand(0,10000)).'.'.$cover->getClientOriginalName();
            $path = '/'.$fileName;

            Storage::put($path,File::get($cover));

            if(Storage::exists($path)){
                $params['cover'] = 'http://188.131.192.194:83/img'.$path;
            }
        }

        $noticeRepo = new NoticeRepo();

        $notice = $noticeRepo->getOne($id);

        if (! $notice) {
            return '数据不存在';
        }

        $result = $noticeRepo->update($notice, $params);

        if (! $result) {
            return view('admin/notice/update');
        }

        return view('admin.notice.show', ['data' => $notice]);
    }

    //删除
    public function delete($id)
    {
        $noticeRepo = new NoticeRepo();

        $notice = $noticeRepo->getOne($id);

        if (! $notice) {
            return '数据不存在';
        }

        $result = $noticeRepo->delete($notice);

        if ($result) {
            return 'ok';
        }else{
            return 'false';
        }
    }

    //详情
    public function show($id)
    {
        $noticeRepo = new NoticeRepo();
        $notice = $noticeRepo->getOne($id);

        if (! $notice) {
            return '数据不存在';
        }

        return view('admin/notice/show', ['data' => $notice]);
    }

    //发布
    public function publish($id)
    {
        $notice = NoticeModel::find($id);

        if (! $notice) {
            return '数据不存在';
        }

        if ($notice->state != 'offline') {
            return 'id为' . $id . '的数据不是下线状态，不能发布';
        }

        $result = $notice->update(['state' => 'published']);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }

    //下线
    public function offline($id)
    {
        $notice = NoticeModel::find($id);

        if (! $notice) {
            return '数据不存在';
        }

        if ($notice->state != 'published') {
            return 'id为' . $id . '的数据不是发布态，不能下线';
        }

        $result = $notice->update(['state' => 'offline']);

        if ($result) {
            return 'ok';
        } else {
            return 'false';
        }
    }
}