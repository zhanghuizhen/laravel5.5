@extends('layouts.app')

@section('title', '用户管理')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>用户管理 <small>列表</small></h1>
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>序号</th>
                <th>用户名</th>
                <th>手机号</th>
                <th>头像</th>
                <th>地址</th>
                <th>背景图</th>
                <th>简介</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->phone}}</td>
                    <td><img style="width:80px; height:50px" src="{{ $value->avatar_url }}" alt=""> </td>
                    <td>{{$value->address}}</td>
                    <td><img style="width:80px; height:50px" src="{{ $value->cover }}" alt=""> </td>
                    <td>{{$value->introduction}}</td>

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/user/show', ['id' => $value->id])}}"><i class="icon-user"></i>详情</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>


@endsection