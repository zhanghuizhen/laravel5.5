@extends('layouts.app')

@section('title', '用户管理')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>用户管理 <small>详情</small></h1>
        </div>
        <table class="table" style="width: 500px;background: white">
            <tr>
                <th>用户名</th>
                <td>{{$data->username}}</td>
            </tr>
            <tr>
                <th>手机号</th>
                <td>{{$data->phone}}</td>
            </tr>
            <tr>
                <th>头像</th>
                <td><img style="width:80px; height:50px" src="{{ $data->avatar_url }}" alt=""></td>
            </tr>
            <tr>
                <th>家庭地址</th>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <th>背景图</th>
                <td><img style="width:80px; height:50px" src="{{ $data->cover }}" alt=""></td>
            </tr>
            <tr>
                <th>简介</th>
                <td>{{$data->introduction}}</td>
            </tr>
            <tr>
                <th>登录时间</th>
                <td>{{$data->logined_at}}</td>
            </tr>
            <tr>
                <th>注销时间</th>
                <td>{{$data->logouted_at}}</td>
            </tr>
            <tr>
                <th>创建时间</th>
                <td>{{$data->created_at}}</td>
            </tr>
            <tr>
                <th>更新时间</th>
                <td>{{$data->updated_at}}</td>
            </tr>
        </table>
    </div>

    <a href="{{url('admin/user/index')}}" class="btn btn-success">返回列表</a>

@endsection